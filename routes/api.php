<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DetectionController;
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

Route::controller(DetectionController::class)->group(function() {
    Route::middleware('auth:sanctum')->group(function() {
        Route::get('detections', 'index');
        Route::post('detections', 'store');
        Route::post('pre-detect', 'preDetect');
    });
});