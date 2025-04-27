<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Katelog;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class KatelogController extends Controller
{
    public function index()
    {
        $katelogs = Katelog::all();
        $categories = Category::orderBy('name', 'asc')->get();

        return view('admin.katelog.senarai', compact('katelogs', 'categories'));
    }

    public function KatalogUmum(Request $request)
    {
        $search = $request->input('search');
        $kategori = $request->input('kategori', 'all');

        $query = Katelog::query();

        if ($search) {
            $query->where('nama', 'like', '%' . $search . '%');
        }

        if ($kategori !== 'all') {
            $query->where('kategori', $kategori);
        }

        $katalogs = $query->get();
        $categories = Category::orderBy('name', 'asc')->get();

        return view('katelog', compact('katalogs', 'search', 'kategori', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'warna' => 'nullable|string|max:255',
            'saiz' => 'nullable|string|max:255',
            'harga' => 'nullable|numeric',
            'stok' => 'nullable|integer',
            'penerangan' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
    
        $gambarPath = null;
    
        if ($request->hasFile('gambar')) {
            $filename = time() . '-' . uniqid() . '.' . $request->file('gambar')->getClientOriginalExtension();
            $path = $request->file('gambar')->storeAs('images', $filename, 'public');
            $gambarPath = $path;
        }
    
        Katelog::create([
            'nama' => $request->nama,
            'kategori' => $request->kategori,
            'warna' => $request->warna,
            'saiz' => $request->saiz,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'penerangan' => $request->penerangan,
            'gambar' => $gambarPath,
        ]);
    
        return redirect()->back()->with('success', 'Produk berjaya ditambah.');
    }
    

    public function update(Request $request, $id)
    {
        $katelog = Katelog::findOrFail($id);
    
        $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'warna' => 'nullable|string|max:255',
            'saiz' => 'nullable|string|max:255',
            'harga' => 'nullable|numeric',
            'stok' => 'nullable|integer',
            'penerangan' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
    
        $gambarPath = $katelog->gambar;
    
        if ($request->hasFile('gambar')) {
            if (\Storage::disk('public')->exists($gambarPath)) {
                \Storage::disk('public')->delete($gambarPath);
            }
    
            $filename = time() . '-' . uniqid() . '.' . $request->file('gambar')->getClientOriginalExtension();
            $path = $request->file('gambar')->storeAs('images', $filename, 'public');
            $gambarPath = $path;
        }
    
        $katelog->update([
            'nama' => $request->nama,
            'kategori' => $request->kategori,
            'warna' => $request->warna,
            'saiz' => $request->saiz,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'penerangan' => $request->penerangan,
            'gambar' => $gambarPath,
        ]);
    
        return redirect()->back()->with('success', 'Produk berjaya dikemaskini.');
    }


    public function destroy($id)
    {
        $katelog = Katelog::findOrFail($id);

        // Delete image if exists
        if (Storage::disk('public')->exists($katelog->gambar)) {
            Storage::disk('public')->delete($katelog->gambar);
        }

        $katelog->delete();

        return redirect()->back()->with('success', 'Gambar berjaya dipadam.');
    }
}
