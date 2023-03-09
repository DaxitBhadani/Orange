<?php

namespace App\Http\Controllers;

use App\Models\Gift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class GiftController extends Controller
{
    public function gifts()
    {
        return view('gifts');
    }
    
    public function giftList(Request $request)
    {
        $totalData = Gift::count();
        $rows = Gift::orderBy('id', 'DESC')->get();

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
            $result = Gift::offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');
            $result = Gift::Where('name', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = Gift::Where('name', 'LIKE', "%{$search}%")->count();
        }
        $data = [];
        foreach ($result as $item) {

            $image = '<img src="./upload/gift/'. $item->image .'" alt="gift image" width="50px" height="50px" style="object-fit: cover;">';
            $edit = '<a href="#" data-image="' . $item->image . '" data-price="' . $item->price . '" class="me-3 btn btn-primary px-4 text-white edit" rel=' . $item->id . ' >' . __('Edit') . '</a>';
            $delete = '<a href="#" class="me-3 btn btn-danger px-4 text-white delete" rel=' . $item->id . ' >' . __('Delete') . '</a>';
            $action = $edit . $delete ;

            $data[] = [
                $image, 
                $item->price, 
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
    public function addGift(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required',
            'price' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->messages()->first(),
            ]);
        }

        $gift = new Gift;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extenstion;
            $file->move('upload/gift', $filename);
            $gift->image = $filename;
        }
        $gift->price = $request->price;
        $gift->save();

        return response()->json([
            'status' => true,
            'message' => 'Gift Added Successfully',
        ]);

    }

    public function updateGift(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'price' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->messages(),
            ]);
        }

        $gift = Gift::find($id);
        if ($gift) {
            if ($request->hasFile('image')) {
                $path = './upload/gift/' . $gift->image;
                if (File::exists($path)) {
                    File::delete($path);
                }
                $file = $request->file('image');
                $extenstion = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extenstion;
                $file->move('./upload/gift/', $filename);
                $gift->image = $filename;
            }
            $gift->price = $request->price;
            $gift->save();
            return response()->json([
                'status' => true,
                'message' => 'Gift Updated Successfully',
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Gift  Not Found',
            ]);
        }
    }

    public function deleteGift($id)
    {
        $gift = Gift::find($id);

        if ($gift) {
            $path = './upload/gift/' . $gift->image;
            if (File::exists($path)) {
                File::delete($path);
            }
            $gift->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Gift Delete Successfully',
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Gift Not Found',
            ]);
        }
    }

    public function fetchGiftsList()
    {
        $fetchGiftsList = Gift::all();
        return response()->json([
            'status' => true,
            'message' => 'Gifts List',
            'data' => $fetchGiftsList,

        ]);
    }


}
