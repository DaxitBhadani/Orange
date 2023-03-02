<?php

namespace App\Http\Controllers;

use App\Models\LiveApplication;
use App\Models\User;
use App\Models\UserImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LiveApplicationController extends Controller
{

    public function liveapplication()
    {
        return view('liveapplication');
    }

    public function addLiveApplication(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'video' => 'required',
            'language' => 'required',
            'about' => 'required',
            'social_link' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->messages()->first(),
            ]);
        }

        $live_app_status = 1;

        $liveapplication = new LiveApplication;
        $liveapplication->user_id = $request->user_id;
        $liveapplication->live_app_status = $live_app_status;
        if ($request->hasfile('video')) {
            $file = $request->file('video');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extenstion;
            $file->move('upload/video', $filename);
            $liveapplication->video = $filename;
        }
        $liveapplication->language = $request->language;
        $liveapplication->about = $request->about;
        $liveapplication->social_link = $request->social_link;
        $liveapplication->save();

        $user = User::where('id', $liveapplication->user_id)->get()->first();
        $user->live_stream = $live_app_status;
        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'Live Application has been send',
            'data' => $liveapplication,
        ]);
        

    }
    public function liveApplicationList(Request $request)
    {
        $totalData = LiveApplication::where('live_app_status', 1)->count();
        $rows = LiveApplication::orderBy('id', 'DESC')->get();

        $result = $rows;

        $columns = [
            0 => 'id',
            1 => 'name',
            2 => 'language'
        ];

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $totalFiltered = $totalData;
        if (empty($request->input('search.value'))) {
            $result = LiveApplication::where('live_app_status', 1)->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');
            $result = LiveApplication::where('live_app_status', 1)->Where('name', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = LiveApplication::where('live_app_status', 1)->Where('name', 'LIKE', "%{$search}%")->count();
        }
        $data = [];
        foreach ($result as $item) {

            $userData = User::where('id', $item->user_id)->get()->first();
            
            $userImage = UserImages::where('user_id', $item->user_id)->get()->first();

            $image = '<img src="upload/user/' . $userImage->user_image . '" width="70" height="70" style="object-fit: cover;border-radius: 10px;box-shadow: 0px 10px 10px -8px #acacac;">';

            $view = '<a href="liveApplicationDetail/' . $item->user_id . '" class="me-3 btn btn-primary px-4 text-white edit" rel=' . $item->id . ' >' . __('View') . '</a>';

            $reject = '<label class="block_switch ms-2"> <input type="checkbox" name="live_stream" rel=' . $item->user_id . ' id="live_stream_status" class="reject_application"><span class="btn text-white sliders badge block">' . __('Reject') . '</span></label>';
            
            $action = $view . $reject ;

            $data[] = [
                $image, 
                $userData->name,
                $item->language,
                $action
            ];
        }
        $json_data = [
            'draw' => intval($request->input('draw')),
            'recordsTotal' => intval($totalData),
            'recordsFiltered' => $totalFiltered,
            'data' => $data,
        ];
        echo json_encode($json_data);
        exit();

    }
    public function liveApplicationDetail($id)
    {
        $userData = User::where('id', $id)->get()->first();
        $userImage = UserImages::where('user_id', $id)->get()->first();
        $liveAppData = LiveApplication::where('user_id', $id)->get()->first();
        return view('liveapplicationDetail',[
            'userData' => $userData,
            'userImage' => $userImage,
            'liveAppData' => $liveAppData,
        ]);
    }

    public function updateLiveAppStatus(Request $request, $id)
    {
        $validator = Validator::make($request->all(), []);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        }

        $live_stream = User::where('id', $id)->get()->first();
        if ($live_stream) {
            if ($request->has('live_stream')) {
                $live_stream->live_stream = $request->live_stream;
            }
            $live_stream->save();

            return response()->json([
                'status' => true,
                'message' => 'Live Application Rejected',
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Live Application Not Found',
            ]);
        }
    }

}
