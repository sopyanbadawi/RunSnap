<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\RunnerSelfie;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ProcessRunnerSelfie implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $selfie;

    /**
     * Create a new job instance.
     */
    public function __construct(RunnerSelfie $selfie)
    {
        $this->selfie = $selfie;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info("Starting background face extraction for Runner Selfie ID: {$this->selfie->id}");

        $imageFullPath = Storage::disk('public')->path($this->selfie->image_path);
        $scriptPath = base_path('app/Scripts/extract_faces.py');

        $result = Process::timeout(300)->run([
            'python3',
            $scriptPath,
            $imageFullPath
        ]);

        if ($result->successful()) {
            $faces = json_decode($result->output(), true);
            if (is_array($faces) && count($faces) > 0) {
                // Use the embedding from the first detected face (usually only one face is in the selfie)
                $this->selfie->update([
                    'face_embedding' => $faces[0]['embedding']
                ]);
                Log::info("Successfully stored face embedding for Runner Selfie ID: {$this->selfie->id}");
            } else {
                Log::warning("No faces detected in Runner Selfie ID: {$this->selfie->id}");
            }
        } else {
            Log::error("Failed to extract faces for Runner Selfie ID: {$this->selfie->id}. Error: " . $result->errorOutput());
        }
    }
}
