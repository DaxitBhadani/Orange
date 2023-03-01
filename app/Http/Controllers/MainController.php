<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $users = User::count();
        $livestream = User::where('live_stream', 1)->count();
        return view('index', [
            'users' => $users,
            'livestream' => $livestream 
        ]);
    }
}
