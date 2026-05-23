<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Photo;
use App\Models\PurchasedPhoto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class FotograferController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        
        // Data dummy sementara atau data aktual
        // Mengambil foto yang diupload fotografer ini
        $myPhotos = Photo::where('fotografer_id', $user->id)->get();
        $totalPhotos = $myPhotos->count();
        
        // Mengambil penjualan dari foto-foto milik fotografer ini
        $myPhotoIds = $myPhotos->pluck('id');
        $totalSales = PurchasedPhoto::whereIn('photo_id', $myPhotoIds)->count();
        $totalEarnings = $totalSales * 25000; // Contoh harga flat atau bisa ambil dari tabel

        $recentUploads = Photo::where('fotografer_id', $user->id)
                            ->with('event')
                            ->orderBy('created_at', 'desc')
                            ->take(5)
                            ->get();

        return view('fotografer.dashboard', compact('totalPhotos', 'totalSales', 'totalEarnings', 'recentUploads'));
    }

    public function upload()
    {
        // Ambil daftar event aktif untuk opsi upload
        $events = Event::where('is_published', 'true')->orderBy('tanggal', 'desc')->get();
        return view('fotografer.upload', compact('events'));
    }

    public function portfolio()
    {
        $user = Auth::user();
        // Grupkan foto berdasarkan event
        $photosByEvent = Photo::where('fotografer_id', $user->id)
                            ->with('event')
                            ->orderBy('created_at', 'desc')
                            ->get()
                            ->groupBy('event_id');
                            
        return view('fotografer.portfolio', compact('photosByEvent'));
    }

    public function earnings()
    {
        $user = Auth::user();
        $myPhotoIds = Photo::where('fotografer_id', $user->id)->pluck('id');
        
        // Ambil riwayat pembelian foto milik fotografer ini
        $purchases = PurchasedPhoto::whereIn('photo_id', $myPhotoIds)
                        ->with(['photo.event', 'user'])
                        ->orderBy('created_at', 'desc')
                        ->paginate(15);
                        
        $totalEarnings = $purchases->count() * 25000; // Logika dummy sementara

        return view('fotografer.earnings', compact('purchases', 'totalEarnings'));
    }

    public function profile()
    {
        $user = Auth::user();
        // Menghitung total foto yang diunggah untuk dipajang di halaman profil
        $totalPhotos = Photo::where('fotografer_id', $user->id)->count();
        return view('fotografer.profile', compact('user', 'totalPhotos'));
    }

    public function updateProfile(Request $request)
    {
        // 1. Validasi inputan (pastikan email unik kecuali milik user ini sendiri)
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
        ]);

        // 2. Ambil data user langsung dari database menggunakan ID
        $user = \App\Models\User::find(Auth::id());
        
        // 3. Timpa dengan data baru
        $user->name = $request->name;
        $user->email = $request->email;
        
        // 4. Simpan paksa ke database
        $user->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }

    public function settings()
    {
        $user = Auth::user();
        return view('fotografer.settings', compact('user'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = \App\Models\User::find(Auth::id());

        // Cek apakah password lama yang dimasukkan benar
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Kata sandi saat ini tidak cocok.']);
        }

        // Simpan password baru
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->back()->with('success', 'Kata sandi berhasil diperbarui!');
    }
}
