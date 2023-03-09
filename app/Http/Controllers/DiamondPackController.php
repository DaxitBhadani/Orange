<?php

namespace App\Http\Controllers;

use App\Models\DiamondPack;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DiamondPackController extends Controller
{
    public function diamondpacks()
    {
        return view('diamondpacks');
    }

    public function diamondPackList(Request $request)
    {
        $totalData = DiamondPack::count();
        $rows = DiamondPack::orderBy('id', 'DESC')->get();

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
            $result = DiamondPack::offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');
            $result = DiamondPack::Where('name', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = DiamondPack::Where('name', 'LIKE', "%{$search}%")->count();
        }
        $data = [];
        foreach ($result as $item) {
            $edit = '<a href="#" data-diamond_amount="' . $item->diamond_amount . '" data-price="' . $item->price . '" data-android_product_id="' . $item->android_product_id . '" data-ios_product_id="' . $item->ios_product_id . '" class="me-3 btn btn-primary px-4 text-white edit" rel=' . $item->id . ' >' . __('Edit') . '</a>';
            $delete = '<a href="#" class="me-3 btn btn-danger px-4 text-white delete" rel=' . $item->id . ' >' . __('Delete') . '</a>';
            $action = $edit . $delete;

            $data[] = [$item->diamond_amount, $item->price, $item->android_product_id, $item->ios_product_id, $action];
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
    public function addDiamondPack(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'diamond_amount' => 'required',
            'price' => 'required',
            'android_product_id' => 'required',
            'ios_product_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->messages()->first(),
            ]);
        }

        $diamondPack = new DiamondPack();
        $diamondPack->diamond_amount = $request->diamond_amount;
        $diamondPack->price = $request->price;
        $diamondPack->android_product_id = $request->android_product_id;
        $diamondPack->ios_product_id = $request->ios_product_id;
        $diamondPack->save();

        return response()->json([
            'status' => true,
            'message' => 'Diamond Pack Added Successfully',
            'data' => $diamondPack,
        ]);
    }
    public function updateDiamondPack(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'diamond_amount' => 'required',
            'price' => 'required',
            'android_product_id' => 'required',
            'ios_product_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->messages(),
            ]);
        }

        $diamondPack = DiamondPack::find($id);
        if ($diamondPack) {
            $diamondPack->diamond_amount = $request->diamond_amount;
            $diamondPack->price = $request->price;
            $diamondPack->android_product_id = $request->android_product_id;
            $diamondPack->ios_product_id = $request->ios_product_id;
            $diamondPack->save();

            return response()->json([
                'status' => true,
                'message' => 'Diamond Pack Updated Successfully',
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Diamond Pack Not Found',
            ]);
        }
    }
    public function deleteDiamondPack($id)
    {
        $diamondPack = DiamondPack::find($id);

        if ($diamondPack) {
            $diamondPack->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Diamond Pack Delete Successfully',
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Diamond Pack Not Found',
            ]);
        }
    }

    public function fetchdiamondPackList()
    {
        $diamondPacks = DiamondPack::all();
        return response()->json([
            'status' => true,
            'message' => 'Fetch Diamond Pack List',
            'data' => $diamondPacks,
        ]);
    }
}
