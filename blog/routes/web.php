<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Admin\StoryAdminController;
use App\Http\Controllers\Admin\CommentAdminController;
use App\Http\Controllers\Admin\ContactAdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Middleware\AdminAuthenticate;

Route::get('/', [StoryController::class, 'index'])->name('home');

Route::get('/kayit-olma-sayfa.html', function () {
    return view('kayit-olma-sayfa');
});

Route::get('/bilgilendirme-sayfa.html', function () {
    return view('bilgilendirme-sayfa');
});

Route::get('/giris-sayfa.html', function () {
    return view('giris-sayfa');
});
Route::get('/sifre-degistirme-sayfa.html', function () {
    return view('sifre-degistirme-sayfa');
});

Route::get('/hikaye/{slug}', [StoryController::class, 'show'])->name('stories.show');
Route::post('/hikaye/{slug}/yorum', [CommentController::class, 'store'])->name('stories.comment');

// İletişim
Route::get('/iletisim', [ContactController::class, 'show'])->name('contact.show');
Route::post('/iletisim', [ContactController::class, 'store'])->name('contact.store');

// Admin login
Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// Admin panel (korumalı)
Route::prefix('admin')->name('admin.')->middleware(AdminAuthenticate::class)->group(function () {
    Route::get('/', fn () => redirect()->route('admin.dashboard'));

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::get('/stories', [StoryAdminController::class, 'index'])->name('stories.index');
    Route::get('/stories/create', [StoryAdminController::class, 'create'])->name('stories.create');
    Route::post('/stories', [StoryAdminController::class, 'store'])->name('stories.store');

    Route::get('/comments', [CommentAdminController::class, 'index'])->name('comments.index');
    Route::post('/comments/{comment}/approve', [CommentAdminController::class, 'approve'])->name('comments.approve');
    Route::delete('/comments/{comment}', [CommentAdminController::class, 'destroy'])->name('comments.destroy');

    Route::get('/contacts', [ContactAdminController::class, 'index'])->name('contacts.index');
    Route::delete('/contacts/{contact}', [ContactAdminController::class, 'destroy'])->name('contacts.destroy');
});
