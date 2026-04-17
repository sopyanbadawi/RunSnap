<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\CheckRole;

Route::get('/login', function () {
    return redirect('/admin/login');
});

Route::get('/', function () {
    return view('landing');
});

Route::get('/register', function () {
    return view('regis');
});

Route::post('/register', [AuthController::class, 'register']);


Route::middleware([
    \Filament\Http\Middleware\Authenticate::class,
])->group(function () {
    Route::get('/runner/dashboard', function () {
        return view('runner.dashboard'); 
    })->name('runner.dashboard');
    Route::get('/fotografer/dashboard', function () {
        return view('fotografer.dashboard');
    })->name('fotografer.dashboard');
});