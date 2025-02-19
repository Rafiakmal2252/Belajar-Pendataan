<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AuthenticationController;

Route::get('/', function () {
    return Auth::check() ? redirect()->route('member.index') : redirect()->route('login');
});

Route::middleware('auth')->group(function () {
    Route::resource('member', MemberController::class);
    Route::get('/logout', [AuthenticationController::class, 'logout'])->name('logout');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return Auth::check() ? redirect()->route('member.index') : view('auth.login');
    })->name('login');

    Route::post('/login', [AuthenticationController::class, 'authenticate'])->name('authenticate');

    Route::get('/register', [RegisterController::class, 'registration'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});
