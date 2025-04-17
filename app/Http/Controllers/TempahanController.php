<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tempahan;  // Import the Tempahan model

class TempahanController extends Controller
{
    public function senarai()
    {
        $tempahan = Tempahan::all(); // Fetch all tempahan records
        return view('admin.tempahan.senarai', compact('tempahan'));
    }

    public function baru()
    {
        // Fetch all tempahan records (existing customers)
        $tempahan = Tempahan::all();

        // Pass the data to the view
        return view('admin.tempahan.borang-tempahan', compact('tempahan'));
    }


        public function store(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'jenis_tempahan' => 'required|string|max:255',
            'tarikh_tempahan' => 'required|date',
            'ukuran_dada' => 'nullable|integer',
            'ukuran_pinggang' => 'nullable|integer',
            'lebar_bahu' => 'nullable|integer',
            'panjang_lengan' => 'nullable|integer',
            'jenis_kain' => 'nullable|string',
            'warna_kain' => 'nullable|string',
            'saiz' => 'nullable|string',
            'harga_tempahan' => 'nullable|numeric',
            'catatan_tambahan' => 'nullable|string',
        ]);

        Tempahan::create([
            'nama_pelanggan' => $request->nama_pelanggan,
            'jenis_tempahan' => $request->jenis_tempahan,
            'tarikh_tempahan' => $request->tarikh_tempahan,
            'ukuran_dada' => $request->ukuran_dada,
            'ukuran_pinggang' => $request->ukuran_pinggang,
            'lebar_bahu' => $request->lebar_bahu,
            'panjang_lengan' => $request->panjang_lengan,
            'jenis_kain' => $request->jenis_kain,
            'warna_kain' => $request->warna_kain,
            'saiz' => $request->saiz,
            'harga_tempahan' => $request->harga_tempahan,
            'catatan_tambahan' => $request->catatan_tambahan,
        ]);

        return redirect()->route('tempahan.senarai')->with('success', 'Tempahan added successfully!');
    }

    public function destroy($id)
    {
        // Find and delete the tempahan record
        $tempahan = Tempahan::findOrFail($id);
        $tempahan->delete();

        return redirect()->route('tempahan.senarai')->with('success', 'Tempahan deleted successfully.');
    }

    public function edit($id)
    {
        // Find the tempahan record by ID
        $tempahan = Tempahan::findOrFail($id);
        // Pass the data to the view
        return view('admin.tempahan.edit-tempahan', compact('tempahan'));
    }

    public function update(Request $request, $id)
    {
        $tempahan = Tempahan::findOrFail($id);
        $tempahan->update($request->all());

        return redirect()->route('tempahan.senarai')->with('success', 'Tempahan berjaya dikemaskini.');
    }

}
