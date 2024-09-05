<?php

use App\Http\Controllers\AuthenticationController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthenticationController::class)->group(function () {

    Route::post('account/auth/login', 'authenticate')->name('authenticate');
    Route::post('account/auth/register', 'register')->name('register');

    Route::post('account/auth/register', 'register')->name('register');
    Route::post('account/auth/verify', 'verify')->name('verify');
    Route::post('account/auth/password/request', 'requestPasswordResetLink')->name('request-password-resetLink');
    Route::post('account/auth/password/validate', 'validatePasswordToken')->name('validate-password-token');
    Route::post('account/auth/password/set', 'setPassword');

    // Logout
    Route::delete('account/auth/logout', 'logout')->name('logout')->middleware('auth:api');
});
