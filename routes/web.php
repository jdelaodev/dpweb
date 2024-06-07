<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\Admin\PostsController as AdminPostController;
use App\Http\Controllers\ReactionsController;
use Illuminate\Support\Facades\Route;
use App\Middleware\AdminMiddleware;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/posts/{id}', [PostController::class, 'show'])->name('user.posts.show');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/posts/{post_id}/comments', [CommentsController::class, 'create'])->name('posts.comments.create');
    Route::post('/posts/{post_id}/reactions', [ReactionsController::class, 'create'])->name('posts.reactions.create');
    Route::delete('/posts/{post_id}/comments/{id}', [CommentsController::class, 'destroy'])->name('posts.comments.destroy');
    
    Route::middleware('admin')->group(function () {
        Route::get('/admin/posts', [AdminPostController::class, 'index'])->name('admin.posts');
        Route::get('/admin/posts/new', [AdminPostController::class, 'new'])->name('admin.posts.new');
        Route::get('/admin/posts/{id}/edit', [AdminPostController::class, 'edit'])->name('admin.posts.edit');
        Route::put('/admin/posts/{id}', [AdminPostController::class, 'update'])->name('admin.posts.update');
        Route::post('/admin/posts', [AdminPostController::class, 'create'])->name('admin.posts.create');
        Route::delete('/admin/posts/{id}', [AdminPostController::class, 'destroy'])->name('admin.posts.destroy');
    });
});

require __DIR__.'/auth.php';
