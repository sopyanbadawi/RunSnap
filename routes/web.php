<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\CheckRole;
use App\Http\Controllers\RunnerController;
use App\Http\Controllers\FotograferController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

Route::get('/login', function () {
    return redirect('/runsnap/login');
})->name('login');

Route::get('/', function () {
    return view('landing');
});



Route::prefix('register')->group(function () {
    Route::get('/', function () {
        return view('register.regis');
    });

    Route::post('/', [AuthController::class, 'register']);

    Route::get('/email/verify', function () {
        return view('register.verify-email');
    })->middleware('auth')->name('verification.notice');

    // Link verifikasi (dikirim via email)
    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();

        // Setelah verifikasi sukses, arahkan ke halaman login
        return redirect()->route('login')
            ->with('success', 'Selamat datang! Email kamu sudah terverifikasi.');
    })->middleware(['auth', 'signed'])->name('verification.verify');

    // Resend link verifikasi
    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Link verifikasi baru sudah dikirim ke email kamu!');
    })->middleware(['auth', 'throttle:6,1'])->name('verification.send');
});


Route::middleware([
    \Filament\Http\Middleware\Authenticate::class,
])->group(function () {
    Route::middleware(['auth'])->prefix('runner')->name('runner.')->group(function() {
        // Rute selfie (harus bisa diakses oleh runner yang belum ambil foto wajah)
        Route::get('/selfie', [RunnerController::class, 'showSelfie'])->name('selfie');
        Route::post('/selfie', [RunnerController::class, 'storeSelfie'])->name('selfie.store');

        // Semua rute utama runner dilindungi oleh middleware runner.has_selfie
        Route::middleware(['runner.has_selfie'])->group(function() {
            Route::get('/dashboard', [RunnerController::class, 'dashboard'])->name('dashboard');
            Route::get('/events', [RunnerController::class, 'events'])->name('events');
            Route::get('/events/{id}', [RunnerController::class, 'show'])->name('events.show');
            Route::get('/gallery', [RunnerController::class, 'gallery'])->name('gallery');
            Route::get('/transactions', [RunnerController::class, 'transactions'])->name('transactions');
            Route::get('/profile', [RunnerController::class, 'profile'])->name('profile');
            Route::get('/settings', [RunnerController::class, 'settings'])->name('settings');
            Route::get('/cart', [RunnerController::class, 'cart'])->name('cart');
        });
    });
    
    Route::middleware(['auth'])->prefix('fotografer')->name('fotografer.')->group(function () {
        Route::get('/verify', [FotograferController::class, 'showVerification'])->name('verify');
        Route::post('/verify', [FotograferController::class, 'submitVerification'])->name('verify.submit');

        Route::middleware(['photographer.verified'])->group(function () {
            Route::get('/dashboard', [FotograferController::class, 'dashboard'])->name('dashboard');
            Route::get('/upload', [FotograferController::class, 'upload'])->name('upload');
            Route::post('/upload', [FotograferController::class, 'storeUpload'])->name('storeUpload');
            Route::get('/portfolio', [FotograferController::class, 'portfolio'])->name('portfolio');
            Route::get('/earnings', [FotograferController::class, 'earnings'])->name('earnings');
            Route::get('/profile', [FotograferController::class, 'profile'])->name('profile');
            Route::post('/profile/update', [FotograferController::class, 'updateProfile'])->name('profile.update');
            Route::get('/settings', [FotograferController::class, 'settings'])->name('settings');
            Route::post('/settings/password', [FotograferController::class, 'updatePassword'])->name('password.update');
            Route::delete('/photos/{id}', [FotograferController::class, 'destroyPhoto'])->name('photos.delete');
        });
    });
});