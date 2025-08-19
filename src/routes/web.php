<?php

use Illuminate\Support\Facades\Route;

// routes/web.php
use App\Http\Controllers\ContactController;

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
