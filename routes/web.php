<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::name('auth.')->controller(AuthController::class)->group(function () {
        Route::get('create-account', 'registerPage')->name('register-page');
        Route::get('login', 'loginPage')->name('login-page');

        Route::post('register', 'register')->name('register');
        Route::post('authentication', 'login')->name('login');
    });
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');
});