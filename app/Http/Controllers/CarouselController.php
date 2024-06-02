<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carousel;
use Illuminate\Support\Facades\Storage;

class CarouselController extends Controller
{
    public function index()
    {
        $items = Carousel::all();
        return view('carousel.index', compact('items'));
    }

    public function create()
    {
        return view('carousel.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'media' => 'required|file|mimes:jpg,jpeg,png,mp4,mov,avi',
        ]);

        $path = $request->file('media')->store('carousel', 'public');

        Carousel::create([
            'media_path' => $path,
            'media_type' => $request->file('media')->getClientMimeType(),
        ]);

        return redirect()->route('carousel.index')->with('success', 'Item added to carousel.');
    }

    public function destroy(Carousel $carousel)
    {
        Storage::disk('public')->delete($carousel->media_path);
        $carousel->delete();

        return redirect()->route('carousel.index')->with('success', 'Item removed from carousel.');
    }
}
