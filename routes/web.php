<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// 認証不要のルート
Route::get('category/{slug}', [CategoryController::class, 'show'])->name('category.show');
Route::get('post', [PostController::class, 'index']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 投稿関連のルート
    Route::get('post/create', [PostController::class, 'create']);
    Route::post('post', [PostController::class, 'store'])->name('post.store');

    // カテゴリー管理関連のルート（認証が必要）
    Route::get('category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('category', [CategoryController::class, 'store'])->name('category.store');
    Route::get('category/{category}/edit', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('category/{category}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('category/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');
});

require __DIR__ . '/auth.php';
