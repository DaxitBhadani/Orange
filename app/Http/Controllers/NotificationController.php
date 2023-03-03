<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NotificationController extends Controller
{
    public function notifications()
    {
        return view('notifications');
    }

    public function notificationList(Request $request)
    {
        $totalData = Notification::count();
        $rows = Notification::orderBy('id', 'DESC')->get();

        $result = $rows;

        $columns = [
            0 => 'id',
            1 => 'image',
        ];

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $totalFiltered = $totalData;
        if (empty($request->input('search.value'))) {
            $result = Notification::offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');
            $result = Notification::Where('title', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = Notification::Where('title', 'LIKE', "%{$search}%")->count();
        }
        $data = [];
        foreach ($result as $item) {


            $edit = '<a href="#" data-title="' . $item->title . '" data-message="' . $item->message . '" class="me-3 btn btn-primary px-4 text-white edit" rel=' . $item->id . ' >' . __('Edit') . '</a>';
            $delete = '<a href="#" class="me-3 btn btn-danger px-4 text-white delete" rel=' . $item->id . ' >' . __('Delete') . '</a>';
            $action = $edit . $delete ;

            $data[] = [
                $item->title,
                $item->message,
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
    public function sendNotification(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'message' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validator->messages()->first(),
            ]);
        }

        $notification = new Notification;
        $notification->title = $request->title;
        $notification->message = $request->message;
        $notification->save();

        return response()->json([
            'status' => 200,
            'message' => 'Notification has been Successfully Send',
            'data' => $notification,
        ]); 

    }

    public function updateNotification(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'message' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        }

        $notification = Notification::find($id);
        if ($notification) {
            $notification->title = $request->title;
            $notification->message = $request->message;
            $notification->save();

            return response()->json([
                'status' => 200,
                'message' => 'Notification Updated Successfully',
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Notification Not Found',
            ]);
        }


    }
}
