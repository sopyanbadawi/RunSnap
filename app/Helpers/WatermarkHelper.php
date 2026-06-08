<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Facades\Log;

class WatermarkHelper
{
    /**
     * Generate watermarked version of an image using Python Pillow.
     * Supports using a custom PNG watermark logo (tiled checkerboard pattern) or falls back to text.
     *
     * @param string $originalPath path relative to public storage
     * @param string $watermarkPath path relative to public storage where watermark image will be saved
     * @return bool
     */
    public static function generate($originalPath, $watermarkPath)
    {
        $originalFullPath = Storage::disk('public')->path($originalPath);
        $watermarkFullPath = Storage::disk('public')->path($watermarkPath);

        // Ensure target directory exists
        $dir = dirname($watermarkFullPath);
        if (!file_exists($dir)) {
            mkdir($dir, 0755, true);
        }

        // Path to custom PNG watermark
        $pngWatermarkFile = public_path('assets/watermark.png');

        // Path to Python script
        $scriptPath = base_path('app/Scripts/watermark.py');

        // Run the Python script using Laravel's Process component
        $result = Process::run([
            'python3',
            $scriptPath,
            $originalFullPath,
            $watermarkFullPath,
            $pngWatermarkFile
        ]);

        if ($result->failed()) {
            Log::error("Watermark Python Script Failed for original: {$originalPath}. Error: " . $result->errorOutput());
            return false;
        }

        return true;
    }
}

