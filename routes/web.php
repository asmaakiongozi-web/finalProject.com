<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfessionalController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DiaryController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResourceController;
use Illuminate\Support\Facades\Route;

// Public route
Route::get('/', function () {
    return view('welcome');
});

// Authenticated route for general dashboard (optional)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Diary routes (authenticated)
Route::middleware(['auth', 'verified'])->prefix('diary')->name('diary.')->group(function () {
    Route::get('/', [DiaryController::class, 'index'])->name('index');
    Route::post('/store', [DiaryController::class, 'store'])->name('store');
    Route::get('/entries', [DiaryController::class, 'getEntries'])->name('entries');
    Route::delete('/entries/{id}', [DiaryController::class, 'destroy'])->name('destroy');
});

// Community Forum routes (authenticated)
Route::middleware(['auth', 'verified'])->prefix('community')->name('community.')->group(function () {
    Route::get('/', [CommunityController::class, 'index'])->name('index');
    Route::post('/store', [CommunityController::class, 'store'])->name('store');
    Route::post('/{id}/reply', [CommunityController::class, 'reply'])->name('reply');
    Route::delete('/{discussionId}/reply/{replyId}', [CommunityController::class, 'destroyReply'])->name('reply.destroy');
    Route::get('/today', [CommunityController::class, 'todayDiscussions'])->name('today');
    Route::get('/recent', [CommunityController::class, 'recentDiscussions'])->name('recent');
    Route::get('/my-posts', [CommunityController::class, 'myPosts'])->name('myPosts');
    Route::delete('/{id}', [CommunityController::class, 'destroy'])->name('destroy');
});

// Profile routes (authenticated)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth routes
require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'adminDashboard'])->name('dashboard');
    Route::get('/users', [HomeController::class, 'manageUsers'])->name('users');
    Route::get('/books', [HomeController::class, 'manageBooks'])->name('books');
    Route::get('/settings', fn () => view('admin.settings'))->name('settings');
    Route::get('/profile', fn () => view('admin.profile'))->name('profile');
    Route::get('/notifications', fn () => view('admin.notifications'))->name('notifications');
    Route::get('/profile/edit', fn () => view('admin.profile-edit'))->name('profile.edit');
    });

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [UserController::class, 'userDashboard'])->name('dashboard');
    Route::get('/resources', [UserController::class, 'resources'])->name('resources'); // example user route
    // Add more user routes here
});

/*
|--------------------------------------------------------------------------
| Resource Library Routes
|--------------------------------------------------------------------------
*/
// Public resource viewing (authenticated users)
Route::middleware(['auth', 'verified'])->prefix('resources')->name('resources.')->group(function () {
    Route::get('/', [ResourceController::class, 'index'])->name('index');
    Route::get('/category/{category}', [ResourceController::class, 'category'])->name('category');
    Route::get('/type/{type}', [ResourceController::class, 'type'])->name('type');
    Route::get('/{resource}', [ResourceController::class, 'show'])->name('show');
});

// Resource management (professionals and admins only)
Route::middleware(['auth', 'verified'])->prefix('resources/manage')->name('resources.')->group(function () {
    Route::get('/create', [ResourceController::class, 'create'])->name('create');
    Route::post('/store', [ResourceController::class, 'store'])->name('store');
    Route::get('/', [ResourceController::class, 'manage'])->name('manage');
    Route::delete('/{resource}', [ResourceController::class, 'destroy'])->name('destroy');
});

/*
|--------------------------------------------------------------------------
| Professional Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'professional'])->prefix('professional')->name('professional.')->group(function () {
    Route::get('/dashboard', [ProfessionalController::class, 'professionalDashboard'])->name('dashboard');
    Route::get('/messages', [ProfessionalController::class, 'messages'])->name('messages');
    Route::get('/clients', [ProfessionalController::class, 'clients'])->name('clients'); // example professional route
    // Add more professional routes here
});