<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\FallbackController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';

Route::redirect('/', '/forum');

Route::post('/locale', LocaleController::class)
    ->name('locale.update');

Route::prefix('/forum')->group(function () {
    Route::get('/', [PostController::class, 'index'])
        ->name('forum.index');
    Route::get('/{post}', [PostController::class, 'show'])
        ->whereNumber('post')
        ->name('forum.show');
});
// GET is needed for the pagination links of the filtered list
Route::match(['get', 'post'], '/filter', [PostController::class, 'filter'])
    ->name('forum.filter');

Route::middleware('auth')->group(function () {
    Route::prefix('/forum')->group(function () {
        Route::get('/create', [PostController::class, 'create'])
            ->name('forum.create');
        Route::post('/', [PostController::class, 'store'])
            ->middleware('throttle:posts')
            ->name('forum.store');
        Route::get('/edit/{post}', [PostController::class, 'edit'])
            ->whereNumber('post')
            ->name('forum.edit');
        Route::patch('/{post}', [PostController::class, 'update'])
            ->whereNumber('post')
            ->name('forum.update');
        Route::delete('/{post}', [PostController::class, 'destroy'])
            ->whereNumber('post')
            ->name('forum.destroy');
    });
    Route::post('/add-comment', [CommentController::class, 'store'])
        ->middleware('throttle:comments')
        ->name('comments.store');
    Route::post('/like', [PostController::class, 'like'])
        ->middleware('throttle:likes')
        ->name('posts.like');
});

Route::fallback(FallbackController::class);
