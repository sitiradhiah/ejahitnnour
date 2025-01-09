<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Katalog;

class KatalogController extends Controller
{
    public function index()
    {
        $katalogs = Katalog::all();
        return view('admin.pengurusan-katalog', compact('katalogs'));

    }

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

    public function update(Request $request, $id)
    {
        $katalog = Katalog::findOrFail($id);

        $katalog->update([
            'nama' => $request->nama,
            'kategori' => $request->kategori,
            'gambar' => $request->hasFile('gambar') ? $request->file('gambar')->store('katalogs', 'public') : $katalog->gambar,
        ]);

        return redirect()->back()->with('success', 'Gambar berjaya dikemas kini.');
    }

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
