<?php

use App\Http\Controllers\LiveApplicationController;
use App\Http\Controllers\LiveHistoryController;
use App\Http\Controllers\ProfileVerificationController;
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
Route::post('addUser', [UserController::class, 'addUser']);

Route::post('addLiveApplication', [LiveApplicationController::class, 'addLiveApplication']);

Route::post('addLiveHistory', [LiveHistoryController::class, 'addLiveHistory']);

Route::post('addProfileVerification', [ProfileVerificationController::class, 'addProfileVerification']);

