<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('landing');
});

Route::get('/register', function () {
    return view('regis');
});

Route::post('/register', [AuthController::class, 'register']);