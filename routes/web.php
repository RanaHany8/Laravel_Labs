<?php
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;
Route::resource('posts', PostController::class);

Route::post('/posts/{post}/comments', [PostController::class, 'storeComment'])->name('comments.store');