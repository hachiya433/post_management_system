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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // 投稿関連のルート
    Route::get('post/create', [PostController::class, 'create']);
    Route::post('post', [PostController::class, 'store'])->name('post.store');
    Route::get('post', [PostController::class, 'index']);
    
    // カテゴリー関連のルート
    Route::get('category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('category/{slug}', [CategoryController::class, 'show'])->name('category.show');
});

require __DIR__.'/auth.php';
