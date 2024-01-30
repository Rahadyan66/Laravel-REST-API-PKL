<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $request->file('image')->store('images');

        $image = Image::create([
            'url' => Storage::url($imagePath),
        ]);

        return response()->json(['url' => $image->url]);
    }

    public function index()
    {
        $images = Image::limit(10)->get(['url']);

        return response()->json($images);
    }
}
