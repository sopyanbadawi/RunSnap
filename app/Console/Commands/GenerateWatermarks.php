<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Photo;
use App\Helpers\WatermarkHelper;
use Illuminate\Support\Facades\Storage;

class GenerateWatermarks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'photos:generate-watermarks {--force : Force regenerate watermark even if the file already exists}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate watermark images for all photo records in the database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $photos = Photo::all();
        $total = $photos->count();

        if ($total === 0) {
            $this->info('No photos found in the database.');
            return 0;
        }

        $this->info("Found {$total} photos. Processing watermarks...");

        $success = 0;
        $failed = 0;
        $skipped = 0;

        foreach ($photos as $photo) {
            $originalPath = $photo->original_path;
            $watermarkPath = $photo->watermark_path;

            // Check if original file exists
            if (!Storage::disk('public')->exists($originalPath)) {
                $this->error("Original photo not found at storage/app/public/{$originalPath} for Photo ID: {$photo->id}");
                $failed++;
                continue;
            }

            // Check if watermark already exists and force is not set
            if (Storage::disk('public')->exists($watermarkPath) && !$this->option('force')) {
                $skipped++;
                continue;
            }

            $this->line("Processing Photo ID: {$photo->id}...");

            $result = WatermarkHelper::generate($originalPath, $watermarkPath);

            if ($result) {
                $success++;
            } else {
                $this->error("Failed to generate watermark for Photo ID: {$photo->id}");
                $failed++;
            }
        }

        $this->info("Watermark generation complete!");
        $this->line("Success: {$success} | Skipped: {$skipped} | Failed: {$failed}");

        return 0;
    }
}
