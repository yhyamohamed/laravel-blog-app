<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\GoogleController;
use App\Models\User;


Route::middleware(['auth', 'auth.session'])->group(function () {
    Route::get('/home', [PostController::class, 'index'])->name('home');
    Route::get('/posts', [App\Http\Controllers\PostController::class, 'index'])->name('posts.index');
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

use Laravel\Socialite\Facades\Socialite;

Route::get('/github/redirect', function () {
    return Socialite::driver('github')->redirect();
})->name('gethub.login');

Route::get('/github/callback', function () {
    $githubUser = Socialite::driver('github')->stateless()->user();
  
// dd($githubUser->id);
    $user = User::firstOrCreate([
        'github_id' => $githubUser->id,
    ],[
        'name' => $githubUser->nickname,
        'password' => Hash::make($githubUser->id),
        'email' =>$githubUser->email,
        'github_id' => $githubUser->id
    ]);
    Auth::login($user);
    return redirect()->route('posts.index');
   
});
Route::get('google', [GoogleController::class, 'redirectToGoogle']);
Route::get('google/callback', [GoogleController::class, 'handleGoogleCallback']);
