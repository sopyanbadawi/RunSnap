<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Photo;
use App\Models\Transaction;
use App\Models\PurchasedPhoto;
use App\Models\RunnerSelfie;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        $event = Event::findOrFail($id);

        $user = auth()->user();
        $selfie = RunnerSelfie::where('user_id', $user->id)->first();

        // Jika user memiliki selfie dengan face embedding yang valid
        if ($selfie && is_array($selfie->face_embedding) && count($selfie->face_embedding) > 0) {
            $targetEmbedding = $selfie->face_embedding;

            // Ambil semua data wajah pada foto-foto di event ini
            $photoFaces = \Illuminate\Support\Facades\DB::table('photo_faces')
                ->join('photos', 'photo_faces.photo_id', '=', 'photos.id')
                ->where('photos.event_id', $event->id)
                ->select('photos.id as photo_id', 'photo_faces.face_embedding')
                ->get();

            $matchedPhotoIds = [];
            foreach ($photoFaces as $photoFace) {
                $embedding = json_decode($photoFace->face_embedding, true);
                if (is_array($embedding) && count($embedding) > 0) {
                    $similarity = $this->cosineSimilarity($targetEmbedding, $embedding);
                    // Threshold kemiripan wajah: 0.45
                    if ($similarity >= 0.45) {
                        $matchedPhotoIds[] = $photoFace->photo_id;
                    }
                }
            }

            // Ambil foto yang cocok saja
            $matchedPhotos = Photo::whereIn('id', array_unique($matchedPhotoIds))
                ->orderBy('created_at', 'desc')
                ->get();

            // Tempelkan relasi foto ke objek event secara manual agar view blade tetap kompatibel
            $event->setRelation('photos', $matchedPhotos);
        } else {
            // Jika belum punya embedding / belum diproses, tampilkan kosong
            $event->setRelation('photos', collect());
        }

        return view('runner.event_detail', compact('event'));
    }

    /**
     * Hitung Cosine Similarity antara dua vektor
     */
    private function cosineSimilarity(array $vec1, array $vec2): float
    {
        $dotProduct = 0.0;
        $normA = 0.0;
        $normB = 0.0;
        $count = count($vec1);

        if ($count !== count($vec2) || $count === 0) {
            return 0.0;
        }

        for ($i = 0; $i < $count; $i++) {
            $dotProduct += $vec1[$i] * $vec2[$i];
            $normA += $vec1[$i] * $vec1[$i];
            $normB += $vec2[$i] * $vec2[$i];
        }

        if ($normA == 0.0 || $normB == 0.0) {
            return 0.0;
        }

        return $dotProduct / (sqrt($normA) * sqrt($normB));
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

    /**
     * Tampilkan halaman ambil foto wajah (selfie)
     */
    public function showSelfie()
    {
        // Jika sudah ada selfie, langsung redirect ke dashboard
        if (auth()->user()->hasSelfie()) {
            return redirect()->route('runner.dashboard');
        }

        return view('runner.selfie');
    }

    /**
     * Simpan foto wajah (selfie) dari kamera
     */
    public function storeSelfie(Request $request)
    {
        $request->validate([
            'image' => 'required|string', // Data URL base64 dari canvas
        ]);

        $user = auth()->user();

        // Jika sudah ada selfie, langsung redirect ke dashboard
        if ($user->hasSelfie()) {
            return redirect()->route('runner.dashboard');
        }

        try {
            // Olah string base64
            $imgData = $request->input('image');
            
            // Format data url: data:image/jpeg;base64,xxxx
            if (preg_match('/^data:image\/(\w+);base64,/', $imgData, $type)) {
                $imgData = substr($imgData, strpos($imgData, ',') + 1);
                $type = strtolower($type[1]); // jpeg, png, dll

                if (!in_array($type, ['jpg', 'jpeg', 'png'])) {
                    return response()->json(['success' => false, 'message' => 'Format gambar tidak didukung.'], 400);
                }

                $imgData = base64_decode($imgData);

                if ($imgData === false) {
                    return response()->json(['success' => false, 'message' => 'Dekode base64 gagal.'], 400);
                }
            } else {
                return response()->json(['success' => false, 'message' => 'Data URL tidak valid.'], 400);
            }

            // Generate nama file unik
            $filename = 'selfie_' . $user->id . '_' . Str::random(10) . '.' . $type;
            $path = 'selfies/' . $filename;

            // Simpan ke storage public
            Storage::disk('public')->put($path, $imgData);

            // Simpan ke database runner_selfies
            $selfie = RunnerSelfie::create([
                'user_id' => $user->id,
                'image_path' => $path,
                'face_embedding' => [], // Kosongkan dulu untuk diproses Python AI nanti
            ]);

            // Kirim tugas ekstraksi wajah ke antrean latar belakang
            \App\Jobs\ProcessRunnerSelfie::dispatch($selfie);

            return response()->json([
                'success' => true,
                'redirect_url' => route('runner.dashboard'),
                'message' => 'Foto wajah berhasil disimpan!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan foto: ' . $e->getMessage()
            ], 500);
        }
    }
}
