<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DiamondPackController;
use App\Http\Controllers\GiftController;
use App\Http\Controllers\InterestController;
use App\Http\Controllers\LiveApplicationController;
use App\Http\Controllers\LiveHistoryController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfileVerificationController;
use App\Http\Controllers\RedeemRequestController;
use App\Http\Controllers\UserController;
use App\Models\LiveApplication;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {return redirect('index');});

Route::post('doLogin',[AdminController::class,'doLogin'])->name('doLogin');
Route::get('login', [AdminController::class,'login'])->name('login');
Route::get('logout', [AdminController::class,'logout'])->name('logout');

Route::get('/index', [MainController::class, 'index'])->middleware(['checkLogin'])->name('index');

Route::post('addFakeUser', [UserController::class, 'addFakeUser'])->middleware(['checkLogin']);
Route::get('users', [UserController::class, 'users'])->middleware(['checkLogin'])->name('users');
Route::get('usersDetail/{id}', [UserController::class, 'usersDetail'])->middleware(['checkLogin'])->name('usersDetail');
Route::get('addFakeUserView', [UserController::class, 'addFakeUserView'])->middleware(['checkLogin'])->name('addFakeUser');
Route::post('updateUserDetail/{id}', [UserController::class, 'updateUserDetail'])->middleware(['checkLogin'])->name('updateUserDetail');


Route::post('allUserslist', [UserController::class, 'allUserslist'])->middleware(['checkLogin']);
Route::post('updateBlockUser/{id}', [UserController::class, 'updateBlockUser'])->middleware(['checkLogin']) ;
Route::post('updateLiveStream/{id}', [UserController::class, 'updateLiveStream'])->middleware(['checkLogin']) ;
Route::post('updateLiveStreamUserDetail/{id}', [UserController::class, 'updateLiveStreamUserDetail'])->middleware(['checkLogin']) ;
Route::post('removeUserImage/{id}', [UserController::class, 'removeUserImage'])->middleware(['checkLogin']) ;

Route::post('fakeUsersList', [UserController::class, 'fakeUsersList'])->middleware(['checkLogin']);
Route::post('LiveStreamerList', [UserController::class, 'LiveStreamerList'])->middleware(['checkLogin']);

Route::get('liveapplication', [LiveApplicationController::class, 'liveapplication'])->middleware(['checkLogin']);
Route::post('liveApplicationList', [LiveApplicationController::class, 'liveApplicationList'])->middleware(['checkLogin']);
Route::get('liveApplicationDetail/{id}', [LiveApplicationController::class, 'liveApplicationDetail'])->middleware(['checkLogin']);
Route::post('updateLiveAppStatus/{id}',[LiveApplicationController::class, 'updateLiveAppStatus'])->middleware(['checkLogin']);

Route::get('livehistory', [LiveHistoryController::class, 'livehistory'])->middleware(['checkLogin']);
Route::post('liveHistoryList', [LiveHistoryController::class, 'liveHistoryList'])->middleware(['checkLogin']);

Route::get('redeemRequests', [RedeemRequestController::class, 'redeemRequests'])->middleware(['checkLogin']);

Route::get('diamondpacks', [DiamondPackController::class, 'diamondpacks'])->middleware(['checkLogin']);
Route::post('addDiamondPack', [DiamondPackController::class, 'addDiamondPack'])->middleware(['checkLogin']);
Route::post('diamondPackList', [DiamondPackController::class, 'diamondPackList'])->middleware(['checkLogin']);
Route::post('updateDiamondPack/{id}', [DiamondPackController::class, 'updateDiamondPack'])->middleware(['checkLogin']);
Route::post('deleteDiamondPack/{id}', [DiamondPackController::class, 'deleteDiamondPack'])->middleware(['checkLogin']);

Route::get('gifts', [GiftController::class, 'gifts'])->middleware(['checkLogin']);
Route::post('addGift', [GiftController::class, 'addGift'])->middleware(['checkLogin']);
Route::post('giftList', [GiftController::class, 'giftList'])->middleware(['checkLogin']);
Route::post('updateGift/{id}', [GiftController::class, 'updateGift'])->middleware(['checkLogin']);
Route::post('deleteGift/{id}', [GiftController::class, 'deleteGift'])->middleware(['checkLogin']);

Route::get('interest', [InterestController::class, 'interest'])->middleware(['checkLogin']);
Route::post('addInterest', [InterestController::class, 'addInterest'])->middleware(['checkLogin']);
Route::post('interestList', [InterestController::class, 'interestList'])->middleware(['checkLogin']);
Route::post('updateInterest/{id}', [InterestController::class, 'updateInterest'])->middleware(['checkLogin']);
Route::post('deleteInterest/{id}', [InterestController::class, 'deleteInterest'])->middleware(['checkLogin']);

Route::get('profileverification', [ProfileVerificationController::class, 'profileverification'])->middleware(['checkLogin']);
Route::post('profileVerificationList', [ProfileVerificationController::class, 'profileVerificationList'])->middleware(['checkLogin']);
Route::post('updateProfileVerification/{id}', [ProfileVerificationController::class, 'updateProfileVerification'])->middleware(['checkLogin']);

Route::get('notifications', [NotificationController::class, 'notifications'])->middleware(['checkLogin']);
Route::post('sendNotification', [NotificationController::class, 'sendNotification'])->middleware(['checkLogin']);
Route::post('notificationList', [NotificationController::class, 'notificationList'])->middleware(['checkLogin']);
Route::post('updateNotification/{id}', [NotificationController::class, 'updateNotification'])->middleware(['checkLogin']);