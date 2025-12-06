<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HeaderImage;
use Illuminate\Support\Facades\Storage;

class HeaderImageController extends Controller
{
    public function index()
    {
        $header = HeaderImage::first();
        return view('admin.header.index', compact('header'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'image' => 'nullable|image|max:2048',
        ]);

        $header = HeaderImage::first();
        if (!$header) {
            $header = new HeaderImage();
        }

        if ($request->hasFile('image')) {
            if ($header->image_path) {
                Storage::disk('public')->delete($header->image_path);
            }
            $path = $request->file('image')->store('header', 'public');
            $header->image_path = $path;
        }
        $header->save();

        return redirect()->back()->with('success', 'Header image updated!');
    }
}
