<?php

use Illuminate\Support\Facades\Route;

// routes/web.php
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [ContactController::class,'index'])->name('contact.index');
Route::post('/confirm', [ContactController::class,'confirm'])->name('contact.confirm');
Route::post('/send', [ContactController::class,'send'])->name('contact.send');
Route::get('/thanks', [ContactController::class,'thanks'])->name('contact.thanks');

// Route::get('/admin', [AuthController::class,'admin'])->name('auth.admin');
Route::middleware('auth')->group(function () {
    Route::get('/admin', [AuthController::class,'admin'])->name('admin');
    Route::post('/logout', [AuthController::class,'destroy'])->name('logout');
    Route::delete('/admin/{contact}', [AuthController::class, 'delete'])->name('admin.delete');
});

// 独自実装のため下記を追加
// Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'create'])->name('register');
    Route::post('/register', [AuthController::class, 'store'])->name('register.post');
//});

// 独自実装のため下記を追加
//Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'send'])->name('login.post');
//});
