<?php

namespace App\Http\Controllers;

use App\Models\DiamondPack;
use App\Models\Gift;
use App\Models\Interest;
use App\Models\LiveApplication;
use App\Models\ProfileVerification;
use App\Models\RedeemRequest;
use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $users = User::get()->count();
        $block_user = User::where('block_user', 1)->count();
        $livestream = User::where('live_stream', 1)->count();
        $liveApplication = LiveApplication::count();
        $pendingRedeem = RedeemRequest::where('is_completed', 0)->count();
        $completedRedeem = RedeemRequest::where('is_completed', 1)->count();
        $diamondPacks = DiamondPack::count();
        $gifts = Gift::count();
        $verificationRequests = ProfileVerification::count();
        $interest = Interest::count();
        $report = Report::count();

        return view('index', [
            'users' => $users,
            'livestream' => $livestream , 
            'block_user' => $block_user,
            'liveApplication' => $liveApplication, 
            'pendingRedeem' => $pendingRedeem, 
            'completedRedeem' => $completedRedeem, 
            'diamondPacks' => $diamondPacks, 
            'gifts' => $gifts, 
            'verificationRequests' => $verificationRequests, 
            'interest' => $interest, 
            'report' => $report, 
        ]);
    }
}
