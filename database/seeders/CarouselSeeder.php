<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CarouselSeeder extends Seeder
{
    public function run()
    {
        DB::table('carousels')->insert([
            [
                'media_path' => 'carousel/image1.jpg',
                'media_type' => 'image/jpeg',
            ],
            [
                'media_path' => 'carousel/video1.mp4',
                'media_type' => 'video/mp4',
            ],
            [
                'media_path' => 'carousel/image2.jpg',
                'media_type' => 'image/jpeg',
            ],
        ]);

        // Assurez-vous que ces fichiers existent dans le dossier storage/app/public/carousel
        Storage::disk('public')->put('carousel/image1.jpg', file_get_contents('https://via.placeholder.com/800x400.png'));
        Storage::disk('public')->put('carousel/video1.mp4', file_get_contents('https://www.learningcontainer.com/wp-content/uploads/2020/05/sample-mp4-file.mp4'));
        Storage::disk('public')->put('carousel/image2.jpg', file_get_contents('https://via.placeholder.com/800x400.png'));
    }
}
