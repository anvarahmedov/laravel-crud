<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\IdeaLikeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Middleware\SetLocale;
use GuzzleHttp\Middleware;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\IdeaController as AdminIdeaController;
use App\Http\Controllers\Admin\CommentController as AdminCommentController;

Route::get('lang/{lang}', function ($lang) {
    app()->setLocale($lang);
    session()->put('locale', $lang);

    return redirect()->route('dashboard');
})
    ->name('change.lang')
    ->middleware(SetLocale::class);

Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware('auth');

Route::post('idea', [IdeaController::class, 'store'])
    ->name('ideas.store')
    ->middleware(['auth']);

Route::resource('ideas', IdeaController::class)
    ->except(['index', 'store', 'show'])
    ->middleware('auth');
Route::resource('ideas', IdeaController::class)->only(['show']);
Route::resource('ideas.comments', CommentController::class)
    ->only(['store'])
    ->middleware('auth');
Route::resource('users', UserController::class)->only('show');
Route::resource('users', UserController::class)
    ->only('show', 'edit', 'update')
    ->middleware('auth');

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::get('profile', [UserController::class, 'profile'])
    ->middleware('auth')
    ->name('profile');

Route::get('users/{user}/follow', [FollowerController::class, 'follow'])
    ->middleware('auth')
    ->name('users.follow');
Route::get('users/{user}/unfollow', [FollowerController::class, 'unfollow'])
    ->middleware('auth')
    ->name('users.unfollow');

Route::get('ideas/{idea}/like', [IdeaLikeController::class, 'like'])
    ->middleware('auth')
    ->name('ideas.like');
Route::get('ideas/{idea}/unlike', [IdeaLikeController::class, 'unlike'])
    ->middleware('auth')
    ->name('ideas.unlike');

Route::get('/feed', [FeedController::class, '__invoke'])
    ->middleware('auth')
    ->name('feed');

Route::get('/terms', function () {
    return view('terms');
})->name('terms');

Route::middleware(['auth', 'can:admin'])
    ->prefix('/admin')
    ->as('dashboard.')
    ->group(function () {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('admin');
        Route::get('/user/{user}/show', [AdminUserController::class, 'show'])->name('user.show');
        Route::get('/user/{user}/edit', [AdminUserController::class, 'edit'])->name('user.edit');
        Route::resource('users', AdminUserController::class)->only('index');
        Route::resource('ideas', AdminIdeaController::class)->only('index');
        Route::resource('comments', AdminCommentController::class)->only('index');
    });
Route::get('comments{id}', [AdminCommentController::class, 'destroy'])->name('comment.destroy');
