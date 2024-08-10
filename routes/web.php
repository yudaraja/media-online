<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IklanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [NewsController::class, 'getBerita']);
Route::get('/news/{news:slug}', [NewsController::class, 'show'])->name('news.show');
Route::post('news/search', [NewsController::class, 'search'])->name('news.search');
Route::get('news/category/{category:slug}', [NewsController::class, 'showCategory'])->name('news.category');
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');


Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // manajemen admin
        Route::get('/daftar-admin', [AdminController::class, 'index'])->name('admin.index');
        Route::get('/daftar-admin/create', [AdminController::class, 'create'])->name('admin.create');
        Route::post('/daftar-admin', [AdminController::class, 'store'])->name('admin.store');
        Route::get('/daftar-admin/{admin}/edit', [AdminController::class, 'edit'])->name('admin.edit');
        Route::put('/daftar-admin/{admin}/update', [AdminController::class, 'update'])->name('admin.update');
        Route::delete('/daftar-admin/{admin}', [AdminController::class, 'destroy'])->name('admin.delete');

        // manajemen kategori
        Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
        Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
        Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
        Route::get('/category/{category}/edit', [CategoryController::class, 'edit'])->name('category.edit');
        Route::put('/category/{category}/update', [CategoryController::class, 'update'])->name('category.update');
        Route::delete('/category/{category}', [CategoryController::class, 'destroy'])->name('category.delete');

        Route::get('/news', [NewsController::class, 'index'])->name('news.index');
        Route::get('/news/create', [NewsController::class, 'create'])->name('news.create');
        Route::post('/news', [NewsController::class, 'store'])->name('news.store');
        Route::get('/news/{news}/edit', [NewsController::class, 'edit'])->name('news.edit');
        Route::put('/news/{news}', [NewsController::class, 'update'])->name('news.update');
        Route::delete('/news/{news}', [NewsController::class, 'destroy'])->name('news.destroy');
        Route::patch('/news/{id}/toggle-headline', [NewsController::class, 'toggleHeadline'])->name('news.toggle-headline');
        Route::patch('/news/{id}/toggle-pilihan', [NewsController::class, 'togglePilihan'])->name('news.toggle-pilihan');
        Route::patch('/news/{id}/toggle-tampil', [NewsController::class, 'toggleTampil'])->name('news.toggle-tampil');

        Route::resource('iklan', IklanController::class);
    });
});

