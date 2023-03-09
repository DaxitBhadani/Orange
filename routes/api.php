<?php

use App\Http\Controllers\DiamondPackController;
use App\Http\Controllers\GiftController;
use App\Http\Controllers\InterestController;
use App\Http\Controllers\LiveApplicationController;
use App\Http\Controllers\LiveHistoryController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileVerificationController;
use App\Http\Controllers\RedeemRequestController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Add User
Route::post('addUser', [UserController::class, 'addUser'])->middleware('checkHeader');

Route::post('addLiveApplication', [LiveApplicationController::class, 'addLiveApplication'])->middleware('checkHeader');

Route::post('addLiveHistory', [LiveHistoryController::class, 'addLiveHistory'])->middleware('checkHeader');

Route::post('addProfileVerification', [ProfileVerificationController::class, 'addProfileVerification'])->middleware('checkHeader');

Route::post('addRedeemrequest', [RedeemRequestController::class, 'addRedeemrequest'])->middleware('checkHeader');

Route::post('addReport', [ReportController::class, 'addReport'])->middleware('checkHeader');


// Fetch User
Route::post('fetchUserList', [UserController::class, 'fetchUserList'])->middleware('checkHeader');
Route::post('fetchPlatformNotificationList', [NotificationController::class, 'fetchPlatformNotificationList'])->middleware('checkHeader');
Route::post('searchUser', [UserController::class, 'searchUser'])->middleware('checkHeader');

Route::post('startMatching', [UserController::class, 'startMatching'])->middleware('checkHeader');

Route::post('addUserInBlock', [UserController::class, 'addUserInBlock'])->middleware('checkHeader');
Route::post('removeUserFromBlockList', [UserController::class, 'removeUserFromBlockList'])->middleware('checkHeader');

Route::post('fetchdiamondPackList', [DiamondPackController::class, 'fetchdiamondPackList'])->middleware('checkHeader');
Route::post('fetchGiftsList', [GiftController::class, 'fetchGiftsList'])->middleware('checkHeader');
Route::post('fetchInterestList', [InterestController::class, 'fetchInterestList'])->middleware('checkHeader');

Route::post('settingApi', [SettingController::class, 'settingApi'])->middleware('checkHeader');