<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        Auth::login($user);

        $user->sendEmailVerificationNotification();

        if ($user->role === 'runner') {
            return redirect()->route('runner.selfie')
                ->with('success', 'Akun berhasil dibuat! Silakan daftarkan foto wajah kamu terlebih dahulu.');
        }

        return redirect()->route('verification.notice')
            ->with('success', 'Akun berhasil dibuat! Silakan cek email kamu untuk verifikasi.');
    }
}
