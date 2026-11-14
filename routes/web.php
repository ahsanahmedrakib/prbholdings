<?php

use App\Http\Controllers\Admin\AmenityController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryImageController;
use App\Http\Controllers\Admin\HeroSlideController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TeamMemberController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/about/team', [PageController::class, 'team'])->name('about.team');
Route::get('/about/privacy-policy', [PageController::class, 'privacy'])->name('about.privacy');
Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');
Route::get('/gallery', [PageController::class, 'gallery'])->name('gallery');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])
    ->middleware('throttle:10,1')
    ->name('contact.store');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest:admin')->group(function () {
        Route::get('login', [AuthController::class, 'create'])->name('login');
        Route::post('login', [AuthController::class, 'store'])->name('login.store');
    });

    Route::middleware('auth:admin')->group(function () {
        Route::get('/', DashboardController::class)->name('dashboard');
        Route::post('logout', [AuthController::class, 'destroy'])->name('logout');

        Route::resource('projects', AdminProjectController::class)->except(['show']);
        Route::resource('hero-slides', HeroSlideController::class)->except(['show']);
        Route::resource('gallery', GalleryImageController::class)->except(['show']);
        Route::resource('testimonials', TestimonialController::class)->except(['show']);
        Route::resource('amenities', AmenityController::class)->except(['show']);
        Route::resource('team', TeamMemberController::class)->except(['show']);

        Route::get('messages', [ContactMessageController::class, 'index'])->name('messages.index');
        Route::get('messages/{message}', [ContactMessageController::class, 'show'])->name('messages.show');
        Route::delete('messages/{message}', [ContactMessageController::class, 'destroy'])->name('messages.destroy');

        Route::get('settings', [SettingController::class, 'edit'])->name('settings.edit');
        Route::put('settings', [SettingController::class, 'update'])->name('settings.update');
    });
});
