<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/',[PostController::class,'index']);
Route::get('/posts',[PostController::class,'index'])->name('index');
Route::get('/posts/create',[PostController::class,'create'])->name('createApost');
Route::post('/posts/create',[PostController::class,'store'])->name('store');
Route::get('/posts/{post}',[PostController::class,'show'])->name('show');
