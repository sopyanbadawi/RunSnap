<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Photo;
use App\Models\PurchasedPhoto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str; // Ditambahkan untuk generate nama file acak
use Illuminate\Support\Facades\Storage;

class FotograferController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        
        $myPhotos = Photo::where('fotografer_id', $user->id)->get();
        $totalPhotos = $myPhotos->count();
        
        $myPhotoIds = $myPhotos->pluck('id');
        $totalSales = PurchasedPhoto::whereIn('photo_id', $myPhotoIds)->count();
        $totalEarnings = $totalSales * 25000; 

        $recentUploads = Photo::where('fotografer_id', $user->id)
                            ->with('event')
                            ->orderBy('created_at', 'desc')
                            ->take(5)
                            ->get();

        return view('fotografer.dashboard', compact('totalPhotos', 'totalSales', 'totalEarnings', 'recentUploads'));
    }

    public function upload()
    {
        $events = Event::where('is_published', 'true')->orderBy('tanggal', 'desc')->get();
        return view('fotografer.upload', compact('events'));
    }

    /**
     * METHOD BARU: Menangani kiriman upload multi-foto dari fotografer
     */
    public function storeUpload(Request $request)
    {

        if ($request->hasFile('photos')) {
            
        // OTOMATISASI: Laravel akan cek dan buat folder ini di dalam storage/app/public/ jika belum ada
        if (!Storage::disk('public')->exists('photos/original')) {
            Storage::disk('public')->makeDirectory('photos/original');
        }
        if (!Storage::disk('public')->exists('photos/watermark')) {
            Storage::disk('public')->makeDirectory('photos/watermark');
        }
    }
        // 1. Validasi Input Form
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'price'    => 'required|numeric|min:10000',
            'photos'   => 'required',
            'photos.*' => 'image|mimes:jpeg,png,jpg|max:10240', // Batasi max 10MB per foto
        ]);

        $user = Auth::user();

        // 2. Periksa apakah ada file yang dikirim
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $file) {
                
                // Membuat nama file acak yang aman dan unik
                $filename = Str::random(25) . '.' . $file->getClientOriginalExtension();
                
                // PENGUMPULAN FILE FISIK: Simpan foto asli di folder 'storage/app/private/photos/original/'
                $originalPath = $file->storeAs('photos/original', $filename, 'public');

                // Menyiapkan jalur path untuk foto ber-watermark (nanti di-generate via script AI/Watermark)
                $watermarkPath = 'photos/watermark/' . $filename;

                // PENGUMPULAN DATA: Masukkan baris data baru ke tabel 'photos' sesuai ERD RunSnap
                Photo::create([
                    'event_id'        => $request->event_id,
                    'fotografer_id'   => $user->id,
                    'original_path'   => $originalPath,
                    'watermark_path'  => $watermarkPath,
                    'is_processed_ai' => false, // Di-set false terlebih dahulu sebelum diproses Python AI
                    'price'           => $request->price,
                ]);
            }

            // Kembalikan ke halaman dashboard dengan pesan sukses
            return redirect()->route('fotografer.dashboard')->with('success', 'Foto-foto berhasil diunggah! Antrean AI sedang berjalan untuk mendeteksi wajah dan nomor BIB.');
        }

        return redirect()->back()->with('error', 'Gagal membaca file foto yang diunggah.');
    }

    public function destroyPhoto($id)
    {
        $photo = Photo::findOrFail($id);

        // Pastikan hanya fotografer yang memiliki foto yang bisa menghapusnya
        if ($photo->fotografer_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk menghapus foto ini.');
        }

        // Hapus file fisik dari storage
        Storage::disk('public')->delete($photo->original_path);
        Storage::disk('public')->delete($photo->watermark_path);

        // Hapus data dari database
        $photo->delete();

        return redirect()->back()->with('success', 'Foto berhasil dihapus.');
    }

    public function portfolio()
    {
        $user = Auth::user();
        //$photosByEvent = Photo::where('fotografer_id', $user->id)
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
        
        $purchases = PurchasedPhoto::whereIn('photo_id', $myPhotoIds)
                        ->with(['photo.event', 'user'])
                        ->orderBy('created_at', 'desc')
                        ->paginate(15);
                        
        $totalEarnings = $purchases->count() * 25000; 

        return view('fotografer.earnings', compact('purchases', 'totalEarnings'));
    }

    public function profile()
    {
        $user = Auth::user();
        $totalPhotos = Photo::where('fotografer_id', $user->id)->count();
        return view('fotografer.profile', compact('user', 'totalPhotos'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
        ]);

        $user = \App\Models\User::find(Auth::id());
        $user->name = $request->name;
        $user->email = $request->email;
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

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Kata sandi saat ini tidak cocok.']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->back()->with('success', 'Kata sandi berhasil diperbarui!');
    }
}