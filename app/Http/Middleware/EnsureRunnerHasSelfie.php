<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class EnsureRunnerHasSelfie
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();
            
            // If the user is a runner and has NOT taken a selfie, redirect them to the selfie page
            if ($user->role === 'runner') {
                $selfie = $user->selfie;

                if (!$selfie) {
                    // Exclude selfie routes and logout route from redirection to prevent infinite loop
                    if (!$request->routeIs('runner.selfie') && 
                        !$request->routeIs('runner.selfie.store') && 
                        !$request->is('runsnap/logout*')
                    ) {
                        return redirect()->route('runner.selfie')
                            ->with('info', 'Harap lakukan verifikasi foto wajah terlebih dahulu untuk melanjutkan.');
                    }
                } else {
                    // Check if the physical file exists
                    if (!\Illuminate\Support\Facades\Storage::disk('public')->exists($selfie->image_path)) {
                        $selfie->delete();
                        if (!$request->routeIs('runner.selfie') && 
                            !$request->routeIs('runner.selfie.store') && 
                            !$request->is('runsnap/logout*')
                        ) {
                            return redirect()->route('runner.selfie')
                                ->with('warning', 'Berkas foto wajah Anda tidak ditemukan. Harap lakukan verifikasi foto wajah kembali.');
                        }
                    } 
                    // If file exists but face embedding is empty, extract on-the-fly
                    elseif (empty($selfie->face_embedding) || count($selfie->face_embedding) === 0) {
                        try {
                            $imageFullPath = \Illuminate\Support\Facades\Storage::disk('public')->path($selfie->image_path);
                            $scriptPath = base_path('app/Scripts/extract_faces.py');

                            $result = \Illuminate\Support\Facades\Process::run([
                                'python3',
                                $scriptPath,
                                $imageFullPath
                            ]);

                            if ($result->successful()) {
                                $faces = json_decode($result->output(), true);
                                if (is_array($faces) && count($faces) > 0) {
                                    $selfie->update([
                                        'face_embedding' => $faces[0]['embedding']
                                    ]);
                                    \Illuminate\Support\Facades\Log::info("On-the-fly face embedding extraction successful for user ID: {$user->id}");
                                } else {
                                    \Illuminate\Support\Facades\Log::warning("No face detected in on-the-fly extraction for user ID: {$user->id}");
                                }
                            } else {
                                \Illuminate\Support\Facades\Log::error("On-the-fly face extraction failed for user ID: {$user->id}. Error: " . $result->errorOutput());
                            }
                        } catch (\Exception $e) {
                            \Illuminate\Support\Facades\Log::error("On-the-fly face extraction exception for user ID: {$user->id}. Error: " . $e->getMessage());
                        }
                    }
                }
            }
        }

        return $next($request);
    }
}
