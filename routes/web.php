<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\CheckRole;
use App\Http\Controllers\RunnerController;
use App\Http\Controllers\FotograferController;

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

// Route::prefix('runsnap')->group(function () {
//     Route::get('/login', function () {
//         return view('login');
//     })->name('login');
//     Route::post('/login', [AuthController::class, 'login']);
// });


Route::middleware([
    \Filament\Http\Middleware\Authenticate::class,
])->group(function () {
    Route::middleware(['auth'])->prefix('runner')->name('runner.')->group(function() {
        Route::get('/dashboard', [RunnerController::class, 'dashboard'])->name('dashboard');
        Route::get('/events', [RunnerController::class, 'events'])->name('events');
        Route::get('/events/{id}', [RunnerController::class, 'show'])->name('events.show');
        Route::get('/gallery', [RunnerController::class, 'gallery'])->name('gallery');
        Route::get('/transactions', [RunnerController::class, 'transactions'])->name('transactions');
        Route::get('/profile', [RunnerController::class, 'profile'])->name('profile');
        Route::get('/settings', [RunnerController::class, 'settings'])->name('settings');
        Route::get('/cart', [RunnerController::class, 'cart'])->name('cart');
    });
    
    Route::middleware(['auth'])->prefix('fotografer')->name('fotografer.')->group(function () {
        Route::get('/dashboard', [FotograferController::class, 'dashboard'])->name('dashboard');
        Route::get('/upload', [FotograferController::class, 'upload'])->name('upload');
        Route::get('/portfolio', [FotograferController::class, 'portfolio'])->name('portfolio');
        Route::get('/earnings', [FotograferController::class, 'earnings'])->name('earnings');
    });
});