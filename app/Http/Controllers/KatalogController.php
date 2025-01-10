<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Katalog;

class KatalogController extends Controller
{
    // Method for the admin view
    public function index()
    {
        $katalogs = Katalog::all();
        return view('admin.pengurusan-katalog', compact('katalogs'));
    }

    // Method to handle the '/katelog' route for the user-facing page
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

        $path = $request->file('gambar')->store('katalogs', 'public');

        Katalog::create([
            'nama' => $request->nama,
            'kategori' => $request->kategori,
            'gambar' => $path,
        ]);

        return redirect()->back()->with('success', 'Gambar berjaya dimuat naik.');
    }

    // Update an existing katalog item
    public function update(Request $request, $id)
    {
        $katalog = Katalog::findOrFail($id);

        $katalog->update([
            'nama' => $request->nama,
            'kategori' => $request->kategori,
            'gambar' => $request->hasFile('gambar') 
                ? $request->file('gambar')->store('katalogs', 'public') 
                : $katalog->gambar,
        ]);

        return redirect()->back()->with('success', 'Gambar berjaya dikemas kini.');
    }

    // Delete a katalog item
    public function destroy($id)
    {
        $katalog = Katalog::findOrFail($id);
        if (\Storage::exists('public/' . $katalog->gambar)) {
            \Storage::delete('public/' . $katalog->gambar);
        }
        $katalog->delete();

        return redirect()->back()->with('success', 'Gambar berjaya dipadam.');
    }
}
