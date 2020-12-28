<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\ChatController;

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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::resource('user',UserController::class);
    Route::resource('post',PostController::class);
    Route::put('updatePostCover', [PostController::class, 'updateCover'])->name('updatePostCover');
    Route::put('updateCover', [UserController::class, 'updateCover'])->name('updateCover');
    Route::post('/reply/store', [CommentController::class,'replyStore'])->name('reply.add');
    Route::resource('comment', CommentController::class);
    Route::delete('unfollow/{user}',[FollowerController::class,'unfollow'])->name('unfollow');
    Route::post('follow/{user}', [FollowerController::class, 'store']);
    // Route::get('chat/{user}', ShowChats::class)->name('chat.show');
    // Route::resource('chat', ShowChats::class);
});