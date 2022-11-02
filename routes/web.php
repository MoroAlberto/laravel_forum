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
/*Route::prefix('/forum')->group(function (){
    Route::get('/', [PostController::class, 'index'])->name('forum.index');
    Route::get('/{id}', [PostController::class, 'show'])->name('forum.show');
    Route::get('/create', [PostController::class, 'create'])->name('forum.create');
    Route::post('/', [PostController::class, 'store'])->name('forum.store');
    Route::get('/edit/{id}', [PostController::class, 'edit'])->name('forum.edit');
    Route::patch('/{id}', [PostController::class, 'update'])->name('forum.update');
    Route::delete('/{id}', [PostController::class, 'destroy'])->name('forum.destroy');
});*/

Route::get('/', [PostController::class, 'index']);
Route::get('/create', [PostController::class, 'create']);
Route::post('/submit', [PostController::class, 'createSubmit']);
Route::get('/{post}/edit', [PostController::class, 'edit']);
Route::post('/{post}/submit', [PostController::class, 'editSubmit']);
Route::get('/{post}/delete', [PostController::class, 'delete']);
Route::post('/login', [LoginController::class, 'login']);
Route::get('/user-creation', [LoginController::class, 'createUser']);
Route::post('/create-submit', [LoginController::class, 'submitUser']);
Route::post('/post-filter', [PostController::class, 'filter']);
Route::post('/add-comment', [CommentController::class, 'add']);
Route::get('/logout', [LoginController::class, 'logout']);

Route::get('/{post}', [PostController::class, 'details']);

//Fallback
Route::fallback(FallbackController::class);
