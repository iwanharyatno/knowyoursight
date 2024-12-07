<?php

use App\Http\Controllers\DetectionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    Auth::loginUsingId(1);
    return view('welcome');
});