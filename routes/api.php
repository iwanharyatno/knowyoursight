<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function() {
    Route::post('register', 'register');
    Route::post('login', 'login');

    Route::middleware('auth:sanctum')->group(function() {
        Route::get('user', 'me');
        Route::put('user/update', 'update');
        Route::put('user/change-password', 'changePassword');
        Route::get('logout', 'logout');
    });
});