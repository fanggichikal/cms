<?php

use App\Http\Controllers\Backend\ArticleController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Middleware\UserAccess;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index']);

// Route::get('/category', [CategoryController::class, 'table']); // untuk menampilkan data table pada controller

Route::middleware('UserAccess:admin')->group(function () {
    Route::resource('/categories', CategoryController::class)->only(['index','store','update','destroy']);
});

Route::middleware('UserAccess:user')->group(function () {
    Route::resource('/categories', CategoryController::class)->only(['index']);
});
// Route::resource('/categories', CategoryController::class)->only(['index','store','update','destroy'])
// ->middleware('UserAccess:admin'); // untuk menampilkan hasil manipulasi data create update delete

// Route::get('/article', [ArticleController::class, 'table']); // untuk menampilkan data table pada controller
Route::resource('/article', ArticleController::class); //untuk menampilkan halaman article beserta controllernya
Route::get('/article/create', [ArticleController::class, 'create'])->name('article.create'); 
Route::post('/article', [ArticleController::class, 'store'])->name('article.store');
Route::get('/article/{id}', [ArticleController::class, 'show'])->name('article.show');
Route::delete('/article/{id}', [ArticleController::class, 'destroy'])->name('article.destroy');
Route::get('/article/{id}/edit', [ArticleController::class, 'edit'])->name('article.edit');
Route::put('/article/{id}', [ArticleController::class, 'update'])->name('article.update');

Route::resource('/users', UserController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



