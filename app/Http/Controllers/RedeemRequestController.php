<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RedeemRequestController extends Controller
{
    public function redeemRequests()
    {
        return view('redeemRequests');
    }
}
