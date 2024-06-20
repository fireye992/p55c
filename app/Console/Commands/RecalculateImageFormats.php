<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Carousel;

class RecalculateImageFormats extends Command
{
    protected $signature = 'images:recalculate-formats';
    protected $description = 'Recalculate the formats for existing images in the database';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $images = Carousel::where('media_type', 'like', 'image/%')->get();

        foreach ($images as $image) {
            $isHorizontal = $this->isHorizontal($image->media_path, $image->media_type);
            $image->is_horizontal = $isHorizontal;
            $image->save();
        }

        $this->info('Image formats recalculated successfully.');
    }

    private function isHorizontal($path, $mediaType)
    {
        $filePath = storage_path('app/public/' . $path);
        
        if (str_contains($mediaType, 'image')) {
            list($width, $height) = getimagesize($filePath);
            return $width >= $height;
        }
        
        return true; // Default to horizontal if not an image
    }
}
