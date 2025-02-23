<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\LearningController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DiscussionController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\InvitationCodeController;

Route::get('/', function () {
    return Auth::check() ? redirect()->route('dashboard.index') : redirect()->route('login');
});

Route::middleware('auth')->group(function () {
    Route::resource('member', MemberController::class);
    Route::resource('learn', LearningController::class);
    Route::resource('discussion', DiscussionController::class);
     // Menampilkan detail diskusi beserta balasan
     Route::get('discussion/{discussion}', [DiscussionController::class, 'show'])->name('discussion.show');

     // Menambahkan balasan ke diskusi
     Route::post('discussion/{discussion}/reply', [DiscussionController::class, 'reply'])->name('discussion.reply');
    Route::get('dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard.index');
    Route::get('/logout', [AuthenticationController::class, 'logout'])->name('logout');
});

// Middleware admin untuk mengelola kode undangan
Route::middleware(AdminMiddleware::class)->group(function () {
    Route::get('/admin/invitations', [InvitationCodeController::class, 'index'])->name('invitation.index');
    Route::post('/admin/invitations', [InvitationCodeController::class, 'store'])->name('invitation.store');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return Auth::check() ? redirect()->route('dashboard.index') : view('auth.login');
    })->name('login');

    Route::post('/login', [AuthenticationController::class, 'authenticate'])->name('authenticate');

    Route::get('/register', [RegisterController::class, 'registration'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});
