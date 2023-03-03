<?php

namespace App\Http\Controllers;

use App\Models\LiveHistory;
use App\Models\User;
use App\Models\UserImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LiveHistoryController extends Controller
{
    public function livehistory()
    {
        return view('livehistory');
    }

    public function liveHistoryList(Request $request)
    {
        $totalData = LiveHistory::count();
        $rows = LiveHistory::orderBy('id', 'DESC')->get();

        $result = $rows;

        $columns = [
            0 => 'id',
            1 => 'name',
            2 => 'started_at',
            3 => 'streamed_for',
            4 => 'coins_collected',
            5 => 'date'
        ];

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $totalFiltered = $totalData;
        if (empty($request->input('search.value'))) {
            $result = LiveHistory::offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');
            $result = LiveHistory::Where('name', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = LiveHistory::Where('name', 'LIKE', "%{$search}%")->count();
        }
        $data = [];
        foreach ($result as $item) {

            $userData = User::where('id', $item->user_id)->get()->first();
            
            $userImage = UserImages::where('user_id', $item->user_id)->get()->first();

            $image = '<img src="upload/user/' . $userImage->user_image . '" width="70" height="70" style="object-fit: cover;border-radius: 10px;box-shadow: 0px 10px 10px -8px #acacac;">';
           

            $data[] = [
                $image, 
                $userData->name,
                $item->started_at,
                $item->streamed_for,
                $item->coins_collected,
                $item->date,
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

    public function addLiveHistory(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'user_id' => 'required',
            'started_at' => 'required',
            'streamed_for' => 'required',
            'coins_collected' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->messages()->first(),
            ]);
        }

        $liveHistory = new LiveHistory;
        $liveHistory->user_id = $request->user_id;
        $liveHistory->started_at = $request->started_at;
        $liveHistory->streamed_for = $request->streamed_for;
        $liveHistory->coins_collected = $request->coins_collected;
        $liveHistory->date = $request->date;
        $liveHistory->save();

        return response()->json([
            'status' => true,
            'message' => 'Live History Added Successfully',
            'data' => $liveHistory,
        ]);
         
    }
    
}
