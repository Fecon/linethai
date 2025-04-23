<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ImageController extends Controller
{
    public function index()
    {
        $images = Image::all();
        return view('images.slider', compact('images'));
    }

    public function manage()
    {
        $images = Image::latest()->get();
        return view('dashboard', compact('images'));
    }

    public function create()
    {
        return view('upload');
    }

    public function store(Request $request)
    {
        $request->validate([
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:20000',
        ]);

        foreach ($request->file('images') as $file) {
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension    = $file->getClientOriginalExtension();

            // Sanitize and slugify filename
            $filename = Str::slug($originalName);

            // Ensure uniqueness
            $counter   = 1;
            $finalName = $filename . '.' . $extension;
            while (file_exists(public_path('images/' . $finalName))) {
                $finalName = $filename . '_' . $counter++ . '.' . $extension;
            }

            // Move file to /public/images
            $file->move(public_path('images'), $finalName);

            // Save to DB
            Image::create([
                'title'      => $finalName,
                'image_path' => 'images/' . $finalName,
            ]);
        }

        return back()->with('success', 'Images uploaded successfully!');
    }

    public function destroy($id)
    {
        $image = Image::findOrFail($id);

        // Delete image file from public/images
        $imagePath = public_path($image->image_path);
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        $image->delete();

        return redirect()->route('images.manage')->with('success', 'Image deleted successfully.');
    }

}
