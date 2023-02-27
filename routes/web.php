<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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

Route::get('users', [UserController::class, 'users'])->middleware(['checkLogin'])->name('users');
