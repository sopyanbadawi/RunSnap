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
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        return redirect()->route('login');
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'email' => ['required' , 'email'],
            'password' =>['required'],
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // 3. Logika Redirect Berdasarkan Role
            // Ini harus sinkron dengan tujuan di middleware CheckRole
            if ($user->role === 'admin') {
                return redirect()->intended('/runsnap');
            } elseif ($user->role === 'runner') {
                return redirect()->intended('/runner/dashboard');
            } elseif ($user->role === 'fotografer') {
                return redirect()->intended('/fotografer/dashboard');
            }

            return redirect()->intended('/');
        }

        // 4. Jika login gagal
        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');

    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
