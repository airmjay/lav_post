<?php

  
use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController; 

Route::get('/', function () {
    return view('welcome');
});
Route::get('/', [PageController::class,'index']);
Route::get('/about', [PageController::class,'about']);
Route::get('/service', [PageController::class, 'service']);

Route::resource('posts', PostsController::class);
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

