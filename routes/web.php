<?php

//use App\Http\Controllers\UC;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', [UserController::class, 'index']);
Route::post('/users',[UserController::class, 'store'])->name('post.user');
Route::get('/delete-user/{id}',[UserController::class, 'destroy'])->name('delete.user');
Route::post('/update-user',[UserController::class, 'update'])->name('update.user');
Route::get('/logout',[UserController::class,'logout'])->name('user_logout');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
