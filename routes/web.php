<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/about', function () {
    return view('about');
})->name('about');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    // Posts Routes
    // Route Limitter (10 requests per user each 10 minutes)
    // Route::resource('posts', PostController::class)->middleware('throttle:10,10');

    Route::resource('posts', PostController::class);

    Route::resource('comments', CommentController::class);

});


Route::get('test', function () {
    return 'TEST';
});