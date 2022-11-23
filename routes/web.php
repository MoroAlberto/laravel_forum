<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\FallbackController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

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
require __DIR__ . '/auth.php';

Route::get('/', function () {
    return redirect()->route('forum.index');
});
Route::prefix('/forum')->group(function () {
    Route::get('/', [PostController::class, 'index'])
        ->name('forum.index');
    Route::get('/{post}', [PostController::class, 'show'])
        ->where('post', '[0-9]+')
        ->name('forum.show');
});
Route::post('/filter', [PostController::class, 'filter']);
Route::fallback(FallbackController::class);

Route::middleware([
    'auth'
])->group(function () {
    Route::prefix('/forum')->group(function () {
        Route::get('/create', [PostController::class, 'create'])
            ->name('forum.create');
        Route::post('/', [PostController::class, 'store'])
            ->name('forum.store');
        Route::get('/edit/{post}', [PostController::class, 'edit'])
            ->where('post', '[0-9]+')
            ->name('forum.edit');
        Route::patch('/{post}', [PostController::class, 'update'])
            ->where('post', '[0-9]+')
            ->name('forum.update');
        Route::delete('/{post}', [PostController::class, 'destroy'])
            ->where('post', '[0-9]+')
            ->name('forum.destroy');
    });
    Route::post('/add-comment', [CommentController::class, 'store']);
    Route::post('/like', [PostController::class, 'like']);
});




