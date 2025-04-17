<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Katelog;
use App\Models\Category;

class KatelogController extends Controller
{
    // Admin view method
    public function index()
    {
        $katelogs = Katelog::all();
        return view('admin.katelog.senarai', compact('katelogs'));
    }

    // Method for user-facing Katelog page
    public function KatalogUmum(Request $request)
    {
        $search = $request->input('search');
        $kategori = $request->input('kategori', 'all');  // Default to 'all' if no category is selected

        $query = Katelog::query();

        if ($search) {
            $query->where('nama', 'like', '%' . $search . '%');
        }

        if ($kategori !== 'all') {
            $query->where('kategori', $kategori);
        }

        $katalogs = $query->get();
        $categories = Category::all(); // Fetch categories from the database

        return view('katelog', compact('katalogs', 'search', 'kategori', 'categories'));
    }


    // Store a new Katelog item
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
        Katelog::create([
            'nama' => $request->nama,
            'kategori' => $request->kategori,
            'gambar' => 'images/' . $request->file('gambar')->getClientOriginalName(),
        ]);

        return redirect()->back()->with('success', 'Gambar berjaya dimuat naik.');
    }

    // Update an existing Katelog item
    public function update(Request $request, $id)
    {
        $Katelog = Katelog::findOrFail($id);

        $gambarPath = $Katelog->gambar; // Retain the existing image path by default

        if ($request->hasFile('gambar')) {
            // Save the new image to public/images directory
            $path = $request->file('gambar')->move(public_path('images'), $request->file('gambar')->getClientOriginalName());
            $gambarPath = 'images/' . $request->file('gambar')->getClientOriginalName();
        }

        // Update Katelog details
        $Katelog->update([
            'nama' => $request->nama,
            'kategori' => $request->kategori,
            'gambar' => $gambarPath,
        ]);

        return redirect()->back()->with('success', 'Gambar berjaya dikemas kini.');
    }

    // Delete a Katelog item
    public function destroy($id)
    {
        $Katelog = Katelog::findOrFail($id);

        // Delete the image file from the public/images directory
        $imagePath = public_path($Katelog->gambar);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        $Katelog->delete();

        return redirect()->back()->with('success', 'Gambar berjaya dipadam.');
    }
}
