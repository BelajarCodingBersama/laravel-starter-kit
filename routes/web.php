<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Developer\RoleController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\ForgotPasswordController;
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

    Route::prefix('forgot-password')
        ->name('password.')
        ->controller(ForgotPasswordController::class)
        ->group(function () {
            Route::get('/', 'index')->name('request');
            Route::post('handler', 'handler')
                ->name('email')
                ->middleware('throttle:3,1440'); // 3 times in 1 day
            Route::get('reset-password/{token}', 'resetPage')->name('reset');
            Route::post('reset-password', 'resetHandler')->name('update');
        });
});

Route::middleware('auth')->group(function () {
    Route::prefix('email-verification')
        ->name('verification.')
        ->controller(EmailVerificationController::class)
        ->group(function () {
            Route::get('/', 'index')
                ->name('notice')
                ->middleware('email-unverified');
            Route::get('handler/{id}/{hash}', 'handler')
                ->name('verify')
                ->middleware('signed');
            Route::post('notification', 'resending')
                ->name('send')
                ->middleware('throttle:3,1440'); // 3 times in 1 day
        });

    Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::name('account.')
        ->controller(AccountController::class)
        ->group(function () {
            Route::get('overview', 'overview')->name('overview');
            Route::get('profile', 'profile')->name('profile');
            Route::patch('update-profile', 'updateProfile')->name('update-profile');
            Route::patch('change-password', 'changePassword')->name('change-password');
        });

    Route::prefix('users')
        ->name('users.')
        ->controller(UserController::class)
        ->group(function () {
            Route::get('/', 'index')->name('index');

            Route::get('{user}/add-roles', 'addRolesPage')->name('add-roles-page');
            Route::post('{user}/add-roles', 'addRoles')->name('add-roles');
        });

    Route::prefix('roles')
        ->name('roles.')
        ->controller(RoleController::class)
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');

            Route::get('{role}/add-permissions', 'addPermissionsPage')->name('add-permissions-page');
            Route::post('{role}/add-permissions', 'addPermissions')->name('add-permissions');

            Route::delete('{role}/delete', 'destroy')->name('delete');
        });

    Route::prefix('permissions')
        ->name('permissions.')
        ->controller(PermissionController::class)
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::delete('{permission}/delete', 'destroy')->name('delete');
        });
});