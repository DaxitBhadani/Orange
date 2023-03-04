<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function login()
    {
        if (Session::get('username')) {
            return redirect('/index');
        }
        return  view('login');
    }

    public function doLogin(Request $req){

        $data = Admin::where('username', $req->username)->first();

        if ($data && $req->username == $data['username'] && $req->password == $data['password']) {
            $req->session()->put('username', $data['username']);
            return  redirect('index');
        } else {
            Session::flash('message', 'Wrong credentials!');
            return redirect()->route('login');
        }
    }

    function logout()
    {

        session()->pull('username');
        return  redirect(url('/login'));
    }
}
