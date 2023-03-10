<?php

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

use Illuminate\Support\Facades\Route;
use Modules\Blog\Http\Controllers\BlogController;

Route::name('blog.')->prefix("blog")->group(function () {
    Route::get('/{post:slug}', [BlogController::class, 'show'])->name('article.single');
    Route::get('/category/{category:slug}', [BlogController::class, 'list'])->name('article.list');
});
