<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\User;
use App\Models\UserImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
{
    public function reports()
    {
        return view('report');
    }

    public function reportList(Request $request)
    {
        $totalData = Report::count();
        $rows = Report::orderBy('id', 'DESC')->get();

        $result = $rows;

        $columns = [
            0 => 'id',
            1 => 'name',
            2 => 'language',
        ];

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $totalFiltered = $totalData;
        if (empty($request->input('search.value'))) {
            $result = Report::offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');
            $result = Report::Where('name', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = Report::Where('name', 'LIKE', "%{$search}%")->count();
        }
        $data = [];
        foreach ($result as $item) {
            $userData = User::where('id', $item->user_id)
                ->get()
                ->first();

            $userImage = UserImages::where('user_id', $item->user_id)
                ->get()
                ->first();

            if ($item->reason == 1) {
                $reason = 'Harrament';
            } elseif ($item->reason == 2) {
                $reason = 'Personal Harrament';
            } else {
                $reason = 'other';
            }

            $image = '<img src="upload/user/' . $userImage->user_image . '" width="70" height="70" style="object-fit: cover;border-radius: 10px;box-shadow: 0px 10px 10px -8px #acacac;">';

            $block = '<label class="block_switch"> <input type="checkbox" name="blockuser" rel=' . $item->user_id . ' id="blockuser" class="blockuser"><span class="btn text-white sliders badge block">' . __('Block User') . '</span></label>';

            $data[] = [$image, $userData->identity, $userData->name, $reason, $item->desc, $block];
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
    public function addReport(Request $request)
    {
        $user = User::where('id', $request->user_id)
            ->get()
            ->first();

        if ($user) {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required',
                'reason' => 'required',
                'desc' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 400,
                    'message' => $validator->messages()->first(),
                ]);
            }

            $report = new Report();
            $report->user_id = $request->user_id;
            $report->reason = $request->reason;
            $report->desc = $request->desc;
            $report->save();

            return response()->json([
                'status' => 200,
                'message' => 'Report Added Successfully',
                'data' => $report,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'User Not Found',
            ]);
        }
    }

    public function reportBlockUser(Request $request, $id)
    {
        $validator = Validator::make($request->all(), []);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        }

        $user = User::where('id', $id)
            ->get()
            ->first();
        if ($user) {
            $user->block_user = 1;

            $user->save();

            $reportData = Report::where('user_id', $request->id)->get();
            $reportData->each->delete();

            return response()->json([
                'status' => 200,
                'message' => 'Report Deleted Successfully',
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Report Not Found',
            ]);
        }
    }
}
