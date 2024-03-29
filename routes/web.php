<?php

use App\Helpers\Helper;
use App\Http\Controllers\GoogleAuthController;
use Illuminate\Support\Facades\Route;
use Modules\Payment\Entities\Payment;

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

Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/auth/google', [GoogleAuthController::class, 'redirect'])->name("auth.google");
Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback'])->name("auth.google.callback");
