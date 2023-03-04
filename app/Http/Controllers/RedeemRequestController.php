<?php

namespace App\Http\Controllers;

use App\Models\RedeemRequest;
use App\Models\Setting;
use App\Models\User;
use App\Models\UserImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RedeemRequestController extends Controller
{
    public function redeemRequests()
    {
        return view('redeemRequests');
    }

    public function pendingRedeemList(Request $request)
    {
        $totalData = RedeemRequest::where('is_completed', 0)->count();
        $rows = RedeemRequest::orderBy('id', 'DESC')->get();

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
            $result = RedeemRequest::where('is_completed', 0)
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');
            $result = RedeemRequest::where('is_completed', 0)
                ->Where('name', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = RedeemRequest::where('is_completed', 0)
                ->Where('name', 'LIKE', "%{$search}%")
                ->count();
        }
        $data = [];
        foreach ($result as $item) {
            $userData = User::where('id', $item->user_id)
                ->get()
                ->first();

            $userImage = UserImages::where('user_id', $item->user_id)
                ->get()
                ->first();

            $setting = Setting::get()->first();

            $payable_amount = $setting->currency . ' ' . $item->payable_amount;

            $image = '<img src="upload/user/' . $userImage->user_image . '" width="70" height="70" style="object-fit: cover;border-radius: 10px;box-shadow: 0px 10px 10px -8px #acacac;">';

            $complete = '<a href="#" class="me-3 btn unblock px-4 text-white complete"  data-username="' . $userData->name . '" data-request_id="' . $item->request_id . '" data-coin_amount="' . $item->coin_amount . '"   data-payment_gateway="' . $item->payment_gateway . '" data-userimage="' . $userImage->user_image . '"  data-account_detail="' . $item->account_detail . '" rel="' . $item->id . '" >' . __('Complete') . '</a>';

            $delete = '<label class="block_switch ms-2"> <input type="checkbox" name="redeem_request" rel=' . $item->id . ' id="redeem_request" class="delete"><span class="btn text-white sliders badge block">' . __('Delete') . '</span></label>';

            $action = $complete . $delete;

            $data[] = [$image, $userData->name, $item->request_id, $item->coin_amount, $payable_amount, $item->payment_gateway, $action];
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

    public function completedRedeemList(Request $request)
    {
        $totalData = RedeemRequest::where('is_completed', 1)->count();
        $rows = RedeemRequest::orderBy('id', 'DESC')->get();

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
            $result = RedeemRequest::where('is_completed', 1)
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');
            $result = RedeemRequest::where('is_completed', 1)
                ->Where('name', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = RedeemRequest::where('is_completed', 1)
                ->Where('name', 'LIKE', "%{$search}%")
                ->count();
        }
        $data = [];
        foreach ($result as $item) {
            $userData = User::where('id', $item->user_id)
                ->get()
                ->first();

            $userImage = UserImages::where('user_id', $item->user_id)
                ->get()
                ->first();

            $setting = Setting::get()->first();

            $amount_paid = $setting->currency . ' ' . $item->amount_paid;

            $image = '<img src="upload/user/' . $userImage->user_image . '" width="70" height="70" style="object-fit: cover;border-radius: 10px;box-shadow: 0px 10px 10px -8px #acacac;">';

            $view = '<a href="#" class="me-3 btn unblock px-4 text-white view"  data-username="' . $userData->name . '" data-request_id="' . $item->request_id . '" data-coin_amount="' . $item->coin_amount . '"   data-payment_gateway="' . $item->payment_gateway . '" data-userimage="' . $userImage->user_image . '"  data-account_detail="' . $item->account_detail . '" data-amount_paid="' . $item->amount_paid . '" rel="' . $item->id . '" >' . __('View') . '</a>';

            $delete = '<label class="block_switch ms-2"> <input type="checkbox" name="redeem_request" rel=' . $item->id . ' id="redeem_request" class="delete"><span class="btn text-white sliders badge block">' . __('Delete') . '</span></label>';

            $action = $view . $delete;

            $data[] = [$image, $userData->name, $item->request_id, $item->coin_amount, $amount_paid, $item->payment_gateway, $action];
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

    public function addRedeemrequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'coin_amount' => 'required',
            'payment_gateway' => 'required',
            'account_detail' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validator->messages()->first(),
            ]);
        }

        $randomRequestId = str::random(8);

        $setting = Setting::get()->first();
        $for_coin_rate = $setting->coin_rate;

        $redeemRequest = new RedeemRequest();
        $redeemRequest->user_id = $request->user_id;
        $redeemRequest->request_id = $randomRequestId;
        $redeemRequest->coin_amount = $request->coin_amount;

        $calc = $for_coin_rate * $request->coin_amount;

        $redeemRequest->payable_amount = $calc;
        $redeemRequest->payment_gateway = $request->payment_gateway;
        $redeemRequest->account_detail = $request->account_detail;
        $redeemRequest->save();

        return response()->json([
            'status' => 200,
            'message' => 'Redeem Request Added Successfully',
            'data' => $redeemRequest,
        ]);
    }

    public function updateRedeemRequest(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'amount_paid' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->messages(),
            ]);
        }

        $redeemRequest = RedeemRequest::find($id);
        if ($redeemRequest) {
            $redeemRequest->is_completed = $request->is_completed;
            $redeemRequest->amount_paid = $request->amount_paid;
            $redeemRequest->save();

            return response()->json([
                'status' => 200,
                'message' => 'Amount Paid Successfully',
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Request Not Found',
            ]);
        }
    }

    public function deleteRedeemRequest($id)
    {
        $redeemRequest = RedeemRequest::find($id);

        if ($redeemRequest) {
            $redeemRequest->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Redeem Request Deleted Successfully',
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Redeem Request Not Found',
            ]);
        }
    }
}
