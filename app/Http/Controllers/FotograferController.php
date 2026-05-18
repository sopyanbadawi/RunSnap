<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Photo;
use App\Models\PurchasedPhoto;
use Illuminate\Support\Facades\Auth;

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
}
