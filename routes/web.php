<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'auth.session'])->group(function () {
    Route::get('/home', [PostController::class, 'index'])->name('home');
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}/restore', [PostController::class, 'restore'])->name('posts.restore');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.delete');
 // =====================================================
    //                      COMMENTS ROUTS
    // =====================================================
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    // =====================================================
    //                      USER ROUTS
    // =====================================================
    // Route::get('/users/{user}',[UserController::class,'show'])->name('posts.show');
});





Auth::routes();

Route::get('/', [HomeController::class, 'index']);
