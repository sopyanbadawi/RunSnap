<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Photo;
use App\Models\Transaction;
use App\Models\PurchasedPhoto;

class RunnerController extends Controller
{
    public function dashboard()
    {
        // Ambil event terbaru yang di-publish
        $trendingEvents = Event::where('is_published', 'true')
            ->orderBy('tanggal', 'desc')
            ->take(3)
            ->get();

        // Ambil preview beberapa foto galeri user terbaru yang pembayarannya berhasil
        $user = auth()->user();
        $recentPhotos = PurchasedPhoto::with(['photo', 'photo.event'])
            ->whereHas('transaction', function($q) {
                $q->where('status', 'completed');
            })
            ->where('user_id', $user->id)
            ->latest()
            ->take(3)
            ->get();

        return view('runner.dashboard', compact('trendingEvents', 'recentPhotos'));
    }

    public function events(Request $request)
    {
        $query = Event::where('is_published', 'true');
        
        // Contoh implementasi filter sederhana
        if ($request->filled('lokasi') && $request->lokasi !== 'Semua Lokasi') {
            $query->where('lokasi', 'LIKE', '%' . $request->lokasi . '%');
        }

        $events = $query->orderBy('tanggal', 'desc')->paginate(8);

        return view('runner.events', compact('events'));
    }

    public function show($id)
    {
        // Ambil data event beserta foto-fotonya
        $event = Event::with(['photos' => function($query) {
            $query->orderBy('created_at', 'desc');
        }])->findOrFail($id);

        return view('runner.event_detail', compact('event'));
    }

    public function gallery()
    {
        $user = auth()->user();
        $purchasedPhotos = PurchasedPhoto::with(['photo', 'photo.event'])
            ->whereHas('transaction', function($q) {
                $q->where('status', 'completed');
            })
            ->where('user_id', $user->id)
            ->latest()
            ->paginate(12);

        return view('runner.gallery', compact('purchasedPhotos'));
    }

    public function transactions()
    {
        $user = auth()->user();
        $transactions = Transaction::where('user_id', $user->id)
            ->latest()
            ->paginate(10);

        return view('runner.transactions', compact('transactions'));
    }

    public function cart()
    {
        // Menggunakan session untuk menyimpan cart sementara
        // Format: session(['cart' => [photo_id_1 => true, photo_id_2 => true]])
        $cart = session()->get('cart', []);
        
        $photos = Photo::with('event')->whereIn('id', array_keys($cart))->get();
        
        $subtotal = $photos->sum('price');
        $serviceFee = count($cart) > 0 ? 2500 : 0;
        $total = $subtotal + $serviceFee;

        return view('runner.cart', compact('photos', 'subtotal', 'serviceFee', 'total'));
    }

    public function profile()
    {
        return view('runner.profile');
    }

    public function settings()
    {
        return view('runner.settings');
    }
}
