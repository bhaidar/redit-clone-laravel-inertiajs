<?php

use App\Http\Controllers\Backend\CommunityController;
use App\Http\Controllers\Backend\CommunityPostController;
use App\Http\Controllers\Frontend\CommunityController as FrontendCommunityController;
use App\Http\Controllers\Frontend\PostController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/r/{community:slug}', [FrontendCommunityController::class, 'show'])->name('frontend.communities.show');
Route::get('/r/{community:slug}/posts/{post:slug}', [PostController::class, 'show'])->name('frontend.posts.show');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::resource('/dashboard/communities', CommunityController::class);

    // Nested resources
    // https://laravel.com/docs/9.x/controllers#restful-nested-resources
    Route::resource('/dashboard/communities.posts', CommunityPostController::class);
});

require __DIR__.'/auth.php';
