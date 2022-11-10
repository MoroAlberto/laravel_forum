<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\FallbackController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
Route::prefix('/forum')->group(function (){
    Route::get('/', [PostController::class, 'index'])->name('forum.index');
    Route::get('/create', [PostController::class, 'create'])->name('forum.create');
    Route::get('/{id}', [PostController::class, 'show'])->name('forum.show');
    Route::post('/', [PostController::class, 'store'])->name('forum.store');
    Route::get('/edit/{id}', [PostController::class, 'edit'])->name('forum.edit');
    Route::patch('/{id}', [PostController::class, 'update'])->name('forum.update');
    Route::delete('/{id}', [PostController::class, 'destroy'])->name('forum.destroy');
});

Route::post('/login', [LoginController::class, 'login']);
Route::get('/user-creation', [LoginController::class, 'createUser']);
Route::post('/create-submit', [LoginController::class, 'submitUser']);
Route::get('/logout', [LoginController::class, 'logout']);

Route::post('/post-filter', [PostController::class, 'filter']);

Route::post('/add-comment', [CommentController::class, 'store']);

//Fallback
Route::fallback(FallbackController::class);
