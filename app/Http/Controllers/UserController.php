<?php

namespace App\Http\Controllers;

use App\Models\LiveApplication;
use App\Models\User;
use App\Models\UserImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function users()
    {
        return view('users');
    }

    public function usersDetail($id)
    {
        $user = User::where('id', $id)
            ->get()
            ->first();
        $user_images = UserImages::where('user_id', $id)->get();

        if ($user) {
            return view('usersDetail', [
                'userId' => $id,
                'user' => $user,
                'user_images' => $user_images,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'User Not Found',
            ]);
        }
    }

    public function allUserslist(Request $request)
    {
        $totalData = User::count();
        $rows = User::orderBy('id', 'DESC')->get();

        $result = $rows;

        $columns = [
            0 => 'id',
            1 => 'image',
            2 => 'identity',
            3 => 'identity',
            4 => 'name',
            5 => 'live_stream',
            6 => 'age',
            7 => 'gender',
            8 => 'block_user',
        ];

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $totalFiltered = $totalData;
        if (empty($request->input('search.value'))) {
            $result = User::offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');
            $result = User::Where('name', 'LIKE', "%{$search}%")
                ->orWhere('identity', 'LIKE', "%{$search}%")
                ->orWhere('age', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = User::Where('name', 'LIKE', "%{$search}%")
                ->orWhere('identity', 'LIKE', "%{$search}%")
                ->orWhere('age', 'LIKE', "%{$search}%")
                ->count();
        }
        $data = [];
        foreach ($result as $item) {
            $userImage = UserImages::where('user_id', $item->id)
                ->get()
                ->first();

            $image = '<img src="upload/user/' . $userImage->user_image . '" width="70" height="70" style="object-fit: cover;border-radius: 10px;box-shadow: 0px 10px 10px -8px #acacac;">';

            if ($item->live_stream == 1) {
                $live_stream = '<span class="live_stream_btn bg-warning"> in Process </span>';
            } elseif ($item->live_stream == 2) {
                $live_stream = '<span class="live_stream_btn "> Yes </span>';
            } else {
                $live_stream = '<span class="live_stream_btn bg-danger"> No </span>';
            }

            if ($item->gender == 1) {
                $gender = '<span class="gender_bg"> Male </span>';
            } else {
                $gender = '<span class="gender_bg"> Female </span>';
            }

            if ($item->block_user == 1) {
                $block_user = '<label class="switch switch-auto"><input type="checkbox" name="block_user" rel="' . $item->id . '" value="' . $item->block_user . '" id="block_user" class="block_user" checked> <span class="btn unblock text-white">  ' . __('Unblock') . ' </span> </label>';
            } else {
                $block_user = '<label class="switch switch-auto"><input type="checkbox" name="block_user" rel="' . $item->id . '" value="' . $item->block_user . '" id="block_user" class="block_user"> <span class="btn block text-white">' . __('Block') . '</span>  </label>';
            }

            $view = '<a href="usersDetail/' . $item->id . '" class="me-3 btn btn-primary px-4 text-white edit" data-image="' . $item->image . '" data-identity="' . $item->identity . '" data-name="' . $item->name . '" data-password="' . $item->password . '" data-lives_at="' . $item->lives_at . '" data-age="' . $item->age . '" data-gender="' . $item->gender . '" data-live_stream="' . $item->live_stream . '" data-block_user="' . $item->block_user . '" data-about="' . $item->about . '" data-bio="' . $item->bio . '" data-youtube="' . $item->youtube . '" data-facebook="' . $item->facebook . '" data-instagram="' . $item->instagram . '" rel=' . $item->id . ' >' . __('View') . '</a>';

            $data[] = [$image, $item->identity, $item->name, $live_stream, $item->age, $gender, $block_user, $view];
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
    public function LiveStreamerList(Request $request)
    {
        $totalData = User::where('live_stream', 2)->count();
        $rows = User::orderBy('id', 'DESC')->get();

        $result = $rows;

        $columns = [
            0 => 'id',
            1 => 'image',
        ];

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $live_stream = 2;

        $totalFiltered = $totalData;
        if (empty($request->input('search.value'))) {
            $result = User::offset($start)
                ->where('live_stream', $live_stream)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');
            $result = User::Where('name', 'LIKE', "%{$search}%")
                ->orWhere('identity', 'LIKE', "%{$search}%")
                ->where('live_stream', $live_stream)
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = User::Where('name', 'LIKE', "%{$search}%")
                ->orWhere('identity', 'LIKE', "%{$search}%")
                ->where('live_stream', $live_stream)
                ->count();
        }
        $data = [];
        foreach ($result as $item) {
            $userImage = UserImages::where('user_id', $item->id)
                ->get()
                ->first();

            $image = '<img src="upload/user/' . $userImage->user_image . '" width="70" height="70" style="object-fit: cover;border-radius: 10px;box-shadow: 0px 10px 10px -8px #acacac;">';

            if ($item->live_stream == 2) {
                $live_stream = '<span class="live_stream_btn "> Yes </span>';
            } else {
                $live_stream = '<span class="live_stream_btn bg-danger"> No </span>';
            }

            if ($item->gender == 1) {
                $gender = '<span class="gender_bg"> Male </span>';
            } else {
                $gender = '<span class="gender_bg"> Female </span>';
            }

            if ($item->block_user == 1) {
                $block_user = '<label class="switch switch-auto"><input type="checkbox" name="block_user" rel="' . $item->id . '" value="' . $item->block_user . '" id="block_user" class="block_user" checked><span class="btn unblock text-white">  ' . __('Unblock') . ' </span> </label>';
            } else {
                $block_user = '<label class="switch switch-auto"><input type="checkbox" name="block_user" rel="' . $item->id . '" value="' . $item->block_user . '" id="block_user" class="block_user"><span class="btn block text-white">' . __('Block') . '</span> </label>';
            }

            $view = '<a href="usersDetail/' . $item->id . '" data-title="' . $item->title . '" data-quality="' . $item->quality . '" data-size="' . $item->size . '" data-download="' . $item->download_type . '" data-sourcetype="' . $item->source_type . '" data-sourceurl="' . $item->source_url . '" data-accesstype="' . $item->access_type . '" class="me-3 btn btn-primary px-4 text-white edit" rel=' . $item->id . ' >' . __('View') . '</a>';

            $data[] = [$image, $item->identity, $item->name, $live_stream, $item->age, $gender, $block_user, $view];
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
    public function fakeUsersList(Request $request)
    {
        $totalData = User::where('user_type', 0)->count();
        $rows = User::orderBy('id', 'DESC')->get();

        $result = $rows;

        $columns = [
            0 => 'id',
            1 => 'image',
        ];

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $user_type = 0;

        $totalFiltered = $totalData;
        if (empty($request->input('search.value'))) {
            $result = User::offset($start)
                ->where('user_type', $user_type)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');
            $result = User::Where('name', 'LIKE', "%{$search}%")
                ->where('user_type', $user_type)
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = User::Where('name', 'LIKE', "%{$search}%")
                ->where('user_type', $user_type)
                ->count();
        }
        $data = [];
        foreach ($result as $item) {
            $userImage = UserImages::where('user_id', $item->id)
                ->get()
                ->first();

            $image = '<img src="upload/user/' . $userImage->user_image . '" width="70" height="70" style="object-fit: cover;border-radius: 10px;box-shadow: 0px 10px 10px -8px #acacac;">';

            if ($item->gender == 1) {
                $gender = '<span class="gender_bg"> Male </span>';
            } else {
                $gender = '<span class="gender_bg"> Female </span>';
            }

            if ($item->block_user == 1) {
                $block_user = '<label class="switch switch-auto"><input type="checkbox" name="block_user" rel="' . $item->id . '" value="' . $item->block_user . '" id="block_user" class="block_user" checked><span class="btn unblock text-white">  ' . __('Unblock') . ' </span> </label>';
            } else {
                $block_user = '<label class="switch switch-auto"><input type="checkbox" name="block_user" rel="' . $item->id . '" value="' . $item->block_user . '" id="block_user" class="block_user"><span class="btn block text-white">' . __('Block') . '</span> </label>';
            }

            
            $view = '<a href="usersDetail/' . $item->id . '" data-title="' . $item->title . '" data-quality="' . $item->quality . '" data-size="' . $item->size . '" data-download="' . $item->download_type . '" data-sourcetype="' . $item->source_type . '" data-sourceurl="' . $item->source_url . '" data-accesstype="' . $item->access_type . '" class="me-3 btn btn-primary px-4 text-white edit" rel=' . $item->id . ' >' . __('View') . '</a>';

            $data[] = [$image, $item->identity, $item->name, $item->password, $item->age, $gender, $block_user, $view];
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

    public function addUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->messages()->first(),
            ]);
        }

        $live_stream = 0;
        $block_user = 0;
        $user_type = 1;

        $user = new User();
        $user->name = $request->name;
        $user->identity = $request->identity;
        $user->password = $request->password;
        $user->lives_at = $request->lives_at;
        $user->age = $request->age;
        $user->gender = $request->gender;

        $user->user_type = $user_type;
        $user->live_stream = $live_stream;
        $user->block_user = $block_user;

        $user->about = $request->about;
        $user->bio = $request->bio;
        $user->youtube = $request->youtube;
        $user->facebook = $request->facebook;
        $user->instagram = $request->instagram;
        $user->save();

        if ($request->hasFile('images')) {
            $files = $request->file('images');
            foreach ($files as $file) {
                $userimage = new UserImages();
                $userimage->user_id = $user->id;
                $fileName = $file->getClientOriginalName();
                $extenstion = $file->getClientOriginalExtension();
                $fileName = time() . rand(1, 900000) . '.' . $extenstion;
                $destinationPath = 'upload/user/' . '/';
                $file->move($destinationPath, $fileName);
                $userimage->user_image = $fileName;
                $userimage->save();
            }
        }

        return response()->json([
            'status' => true,
            'message' => 'User Added Successfully',
            'data' => $user,
        ]);
    }

    // addFakeUser
    public function addFakeUserView()
    {
        return view('addFakeUserView');
    }
    public function addFakeUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->messages()->first(),
            ]);
        }

        $random = Str::random(8);

        $user = new User();
        $user->identity = $random;
        $user->name = $request->name;
        $user->password = 123456789;
        $user->lives_at = $request->lives_at;
        $user->age = $request->age;
        $user->gender = $request->gender;
        $user->about = $request->about;
        $user->bio = $request->bio;
        $user->youtube = $request->youtube;
        $user->facebook = $request->facebook;
        $user->instagram = $request->instagram;
        $user->save();

        if ($request->hasFile('images')) {
            $files = $request->file('images');
            foreach ($files as $file) {
                $userimage = new UserImages();
                $userimage->user_id = $user->id;
                $fileName = $file->getClientOriginalName();
                $extenstion = $file->getClientOriginalExtension();
                $fileName = time() . rand(1, 900000) . '.' . $extenstion;
                $destinationPath = 'upload/user/' . '/';
                $file->move($destinationPath, $fileName);
                $userimage->user_image = $fileName;
                $userimage->save();
            }
        }
        return response()->json([
            'status' => true,
            'message' => 'User Added Successfully',
            'data' => $user,
        ]);
    }

    // updateBlockUser
    public function updateBlockUser(Request $request, $id)
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
            if ($request->has('block_user')) {
                $user->block_user = $request->block_user;
            }
            $user->save();

            return response()->json([
                'status' => true,
                'message' => 'User Updated Successfully',
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'User Not Found',
            ]);
        }
    }
    public function updateLiveStream(Request $request, $id)
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
            if ($request->has('live_stream')) {
                $user->live_stream = $request->live_stream;
            }
            $user->save();

            $LiveApplication = LiveApplication::where('user_id', $request->id)
                ->get()
                ->first();
            $path = 'upload/video/' . $LiveApplication->video;
            if (File::exists($path)) {
                File::delete($path);
            }
            $LiveApplication->delete();

            return response()->json([
                'status' => true,
                'message' => 'User Updated Successfully',
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'User Not Found',
            ]);
        }
    }

    public function updateLiveStreamUserDetail(Request $request, $id)
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
            if ($request->has('live_stream')) {
                $user->live_stream = $request->live_stream;
            }
            $user->save();

            return response()->json([
                'status' => true,
                'message' => 'User Updated Successfully',
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'User Not Found',
            ]);
        }
    }
    public function removeUserImage($id)
    {
        $userImage = UserImages::find($id);

        $path = 'upload/user/' . $userImage->user_image;
        if (File::exists($path)) {
            File::delete($path);
        }
        if ($userImage) {
            $userImage->delete();
            return response()->json([
                'status' => 200,
                'message' => 'User Image Removed Successfully',
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'User Image Not Found',
            ]);
        }
    }

    public function updateUserDetail(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            //    'image' => 'required',
            'name' => 'required',
            'password' => 'required',
            // 'lives_at' => 'required',
            // 'age' => 'required',
            // 'gender' => 'required',
            // 'about' => 'required',
            // 'bio' => 'required',
            // 'youtube' => 'required',
            // 'facebook' => 'required',
            // 'instagram' => 'required',
        ]);

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
            $user->identity = $request->identity;
            $user->name = $request->name;
            $user->password = $request->password;
            $user->lives_at = $request->lives_at;
            $user->age = $request->age;
            // $user->gender = $request->gender;
            $user->about = $request->about;
            $user->bio = $request->bio;
            $user->youtube = $request->youtube;
            $user->facebook = $request->facebook;
            $user->instagram = $request->instagram;

            $user->save();

            if ($request->hasFile('images')) {
                $files = $request->file('images');
                foreach ($files as $file) {
                    $userimage = new UserImages();
                    $userimage->user_id = $user->id;
                    $fileName = $file->getClientOriginalName();
                    $extenstion = $file->getClientOriginalExtension();
                    $fileName = time() . rand(1, 900000) . '.' . $extenstion;
                    $destinationPath = 'upload/user/' . '/';
                    $file->move($destinationPath, $fileName);
                    $userimage->user_image = $fileName;
                    $userimage->save();
                }
            }

            return response()->json([
                'status' => true,
                'message' => 'user Updated Successfully',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'user Not Found',
            ]);
        }
    }
}
