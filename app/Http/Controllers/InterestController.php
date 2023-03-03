<?php

namespace App\Http\Controllers;

use App\Models\Interest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InterestController extends Controller
{
    public function interest()
    {
        return view('interest');
    }

    public function interestList(Request $request)
    {
        $totalData = Interest::count();
        $rows = Interest::orderBy('id', 'DESC')->get();

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
            $result = Interest::offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');
            $result = Interest::Where('title', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = Interest::Where('title', 'LIKE', "%{$search}%")->count();
        }
        $data = [];
        foreach ($result as $item) {
            $edit = '<a href="#" data-title="' . $item->title . '" class="me-3 btn btn-primary px-4 text-white edit" rel=' . $item->id . ' >' . __('Edit') . '</a>';
            $delete = '<a href="#" class="me-3 btn btn-danger px-4 text-white delete" rel=' . $item->id . ' >' . __('Delete') . '</a>';
            $action = $edit . $delete;

            $data[] = [
                $item->title,
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

    public function addInterest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()->first(),
            ]);
        }

        $interest = new Interest;
        $interest->title = $request->title;
        $interest->save();

        return response()->json([
            'status' => 200,
            'message' => 'interest Added Successfully',
            'data' => $interest,
        ]);
    }

    public function updateInterest(Request $request, $id)
    {
        
        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        }

        $interest = Interest::find($id);
        if ($interest) {
            $interest->title = $request->title;
            $interest->save();

            return response()->json([
                'status' => 200,
                'message' => 'Interest Updated Successfully',
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Interest Not Found',
            ]);
        }
    }

    public function deleteInterest($id)
    {
        $interest = Interest::find($id);

        if ($interest) {
            $interest->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Interest Delete Successfully',
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Interest Not Found',
            ]);
        }
    }
}


