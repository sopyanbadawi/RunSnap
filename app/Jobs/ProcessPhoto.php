<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Photo;
use App\Models\PhotoFace;
use App\Helpers\WatermarkHelper;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ProcessPhoto implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $photo;

    /**
     * Create a new job instance.
     */
    public function __construct(Photo $photo)
    {
        $this->photo = $photo;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info("Starting background watermark & face extraction for Photo ID: {$this->photo->id}");

        // 1. Generate Watermark
        $watermarkResult = WatermarkHelper::generate($this->photo->original_path, $this->photo->watermark_path);
        if (!$watermarkResult) {
            Log::error("Failed to generate watermark for Photo ID: {$this->photo->id}");
        }

        // 2. Extract Faces
        $originalFullPath = Storage::disk('public')->path($this->photo->original_path);
        $scriptPath = base_path('app/Scripts/extract_faces.py');

        $result = Process::timeout(300)->run([
            'python3',
            $scriptPath,
            $originalFullPath
        ]);

        if ($result->successful()) {
            $faces = json_decode($result->output(), true);
            if (is_array($faces)) {
                foreach ($faces as $faceData) {
                    PhotoFace::create([
                        'photo_id' => $this->photo->id,
                        'bounding_box' => $faceData['bounding_box'],
                        'face_embedding' => $faceData['embedding']
                    ]);
                }
                Log::info("Successfully extracted " . count($faces) . " faces for Photo ID: {$this->photo->id}");
            }
        } else {
            Log::error("Failed to extract faces for Photo ID: {$this->photo->id}. Error: " . $result->errorOutput());
        }

        // 3. Mark as processed by AI
        $this->photo->update(['is_processed_ai' => true]);
    }
}
