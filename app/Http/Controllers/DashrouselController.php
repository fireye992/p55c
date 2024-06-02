<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carousel;
use FFMpeg\FFMpeg;

class DashrouselController extends Controller
{
    public function index()
    {
        $carouselItems = Carousel::all();

        $horizontalItems = $carouselItems->filter(function ($item) {
            return $this->isHorizontal($item);
        });

        $verticalItems = $carouselItems->filter(function ($item) {
            return !$this->isHorizontal($item);
        });

        return view('dashrousel', [
            'horizontalItems' => $horizontalItems,
            'verticalItems' => $verticalItems,
        ]);
    }

    private function isHorizontal($item)
    {
        $filePath = storage_path('app/public/' . $item->media_path);
        if (str_contains($item->media_type, 'image')) {
            list($width, $height) = getimagesize($filePath);
            return $width >= $height;
        } elseif (str_contains($item->media_type, 'video')) {
            $ffprobe = \FFMpeg\FFProbe::create();
            $dimensions = $ffprobe
                ->streams($filePath) // extracts streams informations
                ->videos() // filters video streams
                ->first() // returns the first video stream
                ->getDimensions();
            return $dimensions->getWidth() >= $dimensions->getHeight();
        }
        return true; // Default to horizontal if we cannot determine size
    }
}

    /////version sans FFProbe
//     class DashrouselController extends Controller
// {
//     public function index()
//     {
//         $carouselItems = Carousel::all();

//         $horizontalItems = $carouselItems->filter(function($item) {
//             return $this->isHorizontal($item);
//         });

//         $verticalItems = $carouselItems->filter(function($item) {
//             return !$this->isHorizontal($item);
//         });

//         return view('dashrousel', compact('horizontalItems', 'verticalItems'));
//     }

//     private function isHorizontal($item)
//     {
//         $filePath = storage_path('app/public/' . $item->media_path);
//         if (str_contains($item->media_type, 'image')) {
//             list($width, $height) = getimagesize($filePath);
//             return $width >= $height;
//         }
//         // For videos, we assume horizontal if we cannot determine size
//         return true;
//     }
// }

