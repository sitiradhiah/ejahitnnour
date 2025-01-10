<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Katalog;

class KatalogController extends Controller
{
    // Admin view method
    public function index()
    {
        $katalogs = Katalog::all();
        return view('admin.pengurusan-katalog', compact('katalogs'));
    }

    // Method for user-facing katalog page
    public function showKatalog()
    {
        $katalogs = Katalog::all(); // Fetch all catalog items
        return view('katelog', compact('katalogs')); // Ensure 'katelog.blade.php' is the correct file
    }

    // Store a new katalog item
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'kategori' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Save the image to public/images directory
        $path = $request->file('gambar')->move(public_path('images'), $request->file('gambar')->getClientOriginalName());

        // Store the relative path in the database
        Katalog::create([
            'nama' => $request->nama,
            'kategori' => $request->kategori,
            'gambar' => 'images/' . $request->file('gambar')->getClientOriginalName(),
        ]);

        return redirect()->back()->with('success', 'Gambar berjaya dimuat naik.');
    }

    // Update an existing katalog item
    public function update(Request $request, $id)
    {
        $katalog = Katalog::findOrFail($id);

        $gambarPath = $katalog->gambar; // Retain the existing image path by default

        if ($request->hasFile('gambar')) {
            // Save the new image to public/images directory
            $path = $request->file('gambar')->move(public_path('images'), $request->file('gambar')->getClientOriginalName());
            $gambarPath = 'images/' . $request->file('gambar')->getClientOriginalName();
        }

        // Update katalog details
        $katalog->update([
            'nama' => $request->nama,
            'kategori' => $request->kategori,
            'gambar' => $gambarPath,
        ]);

        return redirect()->back()->with('success', 'Gambar berjaya dikemas kini.');
    }

    // Delete a katalog item
    public function destroy($id)
    {
        $katalog = Katalog::findOrFail($id);

        // Delete the image file from the public/images directory
        $imagePath = public_path($katalog->gambar);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        $katalog->delete();

        return redirect()->back()->with('success', 'Gambar berjaya dipadam.');
    }
}
