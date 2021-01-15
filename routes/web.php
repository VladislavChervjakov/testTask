<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::get('/register', function (){
    return redirect('/');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->middleware('auth', 'is_admin')
    ->name('home');

Route::get('/news/orderByDate', '\App\Http\Controllers\News\NewsController@orderByDate')
    ->name('news.orderByDate');

Route::get('/news/orderByViews', '\App\Http\Controllers\News\NewsController@orderByViews')
    ->name('news.orderByViews');

Route::middleware(['is_admin', 'auth'])->group(function() {
    Route::resource('news', \App\Http\Controllers\News\NewsController::class)
        ->only('create', 'store', 'update', 'edit', 'destroy');
});

Route::resource('news', \App\Http\Controllers\News\NewsController::class)
    ->only('index', 'show');



Route::middleware(['is_admin', 'auth'])->group(function() {
    Route::resource('reviews', \App\Http\Controllers\Reviews\ReviewsController::class)
        ->only( 'update', 'edit', 'destroy');
});

Route::resource('reviews', \App\Http\Controllers\Reviews\ReviewsController::class)
    ->only('index', 'show', 'create', 'store');

