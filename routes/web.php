<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LiveApplicationController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ProfileController;
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