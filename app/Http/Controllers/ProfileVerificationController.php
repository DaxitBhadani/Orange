<?php

namespace App\Http\Controllers;

use App\Models\ProfileVerification;
use App\Models\User;
use App\Models\UserImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ProfileVerificationController extends Controller
{
    public function profileverification()
    {
        return view('profileverification');
    }

    // profileVerificationList
    public function profileVerificationList(Request $request)
    {
        $totalData = ProfileVerification::count();
        $rows = ProfileVerification::orderBy('id', 'DESC')->get();

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
            $result = ProfileVerification::offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');
            $result = ProfileVerification::Where('name', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = ProfileVerification::Where('name', 'LIKE', "%{$search}%")->count();
        }
        $data = [];
        foreach ($result as $item) {

            $userData = User::where('id', $item->user_id)->get()->first();

            $fetchUserImage = UserImages::where('user_id', $item->user_id)->get()->first();

            $UserImage = '<img src="./upload/user/'. $fetchUserImage->user_image .'" alt="User image" width="50px" height="50px" style="object-fit: cover;">';
            $selfieImage = '<img src="./upload/verified/'. $item->selfie .'" alt="Selfie image" width="50px" height="50px" style="object-fit: cover;">';
            $docImage = '<img src="./upload/verified/'. $item->document .'" alt="ducument image" width="50px" height="50px" style="object-fit: cover;">';

            if ($item->document_type == 1) {
                $doc_type = 'Driving Licence';
            } else {
                $doc_type = 'National ID Card';
            }
            $approve = '<label class="block_switch ms-2"> <input type="checkbox" name="is_verified" rel=' . $item->user_id . ' id="profile_verify_approve" class="approve_profile"><span class="btn text-white sliders badge unblock">' . __('Approv') . '</span></label>';
            $reject = '<label class="block_switch ms-2"> <input type="checkbox" name="is_verified" rel=' . $item->user_id . ' id="profile_verify" class="reject_profile"><span class="btn text-white sliders badge block">' . __('Reject') . '</span></label>';
            
            $action = $approve . $reject ;

            $data[] = [
                $UserImage,
                $selfieImage, 
                $docImage,
                $doc_type,
                $item->full_name,
                $userData->identity,
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

    public function addProfileVerification(Request $request)
    {

        $user = User::where('id', $request->user_id)->get()->first();

        if ($user->is_verified == 0) {
            $validator = Validator::make($request->all(),[
                'selfie' => 'required',
                'document' => 'required',
                'document_type' => 'required',
                'full_name' => 'required',
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'status' => 400,
                    'message' => $validator->messages()->first(),
                ]);
            }
    
            $profileVerification = new ProfileVerification;
            $profileVerification->user_id = $request->user_id;
    
            if ($request->hasFile('selfie')) {
                $file = $request->file('selfie');
                $extenstion = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extenstion;
                $file->move('upload/verified/', $filename);
                $profileVerification->selfie = $filename;
            }
            if ($request->hasFile('document')) {
                $file = $request->file('document');
                $extenstion = $file->getClientOriginalExtension();
                $filename = 'doc_' .time() . '.' . $extenstion;
                $file->move('upload/verified/', $filename);
                $profileVerification->document = $filename;
            }
            $profileVerification->document_type = $request->document_type;
            $profileVerification->full_name = $request->full_name;
            $profileVerification->save();
    
            $is_verified = 1;

            $user->is_verified = $is_verified;
            $user->save();
    
            return response()->json([
                'status' => 200,
                'message' => 'Profile Verification added Successfully',
                'data' => $profileVerification,
            ]); 
        }
        else {
            return response()->json([
                'status' => 200,
                'message' => 'Profile Verification Already in Pending',
            ]); 
        }
        
       
    }

    public function updateProfileVerification(Request $request, $id)
    {
        $validator = Validator::make($request->all(), []);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        }

        $user = User::where('id', $id)->get()->first();
        if ($user) {
            if ($request->has('is_verified')) {
                $user->is_verified = $request->is_verified;
            }
            $user->save();

            $profileVerification = ProfileVerification::where('user_id', $request->id)->get()->first();
            
            $path = './upload/verified/' . $profileVerification->selfie;
            $path1 = './upload/verified/' . $profileVerification->document;
            if (File::exists($path) &&  File::exists($path1)) {
                File::delete($path);
                File::delete($path1);
            }

            $profileVerification->delete();

            return response()->json([
                'status' => 200,
                'message' => 'Record Updated Successfully',
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Record Not Found',
            ]);
        }
    }

}
