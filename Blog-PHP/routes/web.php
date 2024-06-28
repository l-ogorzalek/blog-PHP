<?php

use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Fortify;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminUserController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

    // Trasy dla zarządzania postami w panelu admina
    Route::get('admin/posts', [AdminPostController::class, 'index'])->name('admin.posts.index');
    Route::get('admin/posts/create', [AdminPostController::class, 'create'])->name('admin.posts.create');
    Route::post('admin/posts', [AdminPostController::class, 'store'])->name('admin.posts.store');
    Route::get('admin/posts/{post}/edit', [AdminPostController::class, 'edit'])->name('admin.posts.edit');
    Route::put('admin/posts/{post}', [AdminPostController::class, 'update'])->name('admin.posts.update');
    Route::delete('admin/posts/{post}', [AdminPostController::class, 'destroy'])->name('admin.posts.destroy');

    // Trasy dla zarządzania użytkownikami w panelu admina
    Route::get('admin/users', [AdminUserController::class, 'index'])->name('admin.users.index');
    Route::get('admin/users/{user}', [AdminUserController::class, 'show'])->name('admin.users.show');
    Route::delete('admin/users/{user}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
});

Route::resource('posts', PostController::class);

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');

Route::resource('comments', CommentController::class);

Fortify::loginView(function () {
    return view('auth.login');
});

Fortify::registerView(function () {
    return view('auth.register');
});
