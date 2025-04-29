<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tempahan;

class TempahanController extends Controller
{
    // Papar senarai tempahan
    public function senarai()
    {
        $tempahan = Tempahan::all();
        return view('admin.tempahan.senarai', compact('tempahan'));
    }

    // Papar borang tempahan baru
    public function baru()
    {
        $tempahan = Tempahan::all(); // pengguna lama
        return view('admin.tempahan.borang-tempahan', compact('tempahan'));
    }

    // Simpan tempahan baru
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
            'alamat' => $request->alamat,
            'nombor_telefon' => $request->nombor_telefon,
            'jenis_tempahan' => $request->jenis_tempahan,
            'tarikh_tempahan' => $request->tarikh_tempahan,
            'chest_size' => $request->ukuran_dada,
            'waist_size' => $request->ukuran_pinggang,
            'shoulder_width' => $request->lebar_bahu,
            'sleeve_length' => $request->panjang_lengan,
            'jenis_kain' => $request->jenis_kain,
            'warna_kain' => $request->warna_kain,
            'size' => $request->saiz,
            'harga_tempahan' => $request->harga_tempahan,
            'additional_notes' => $request->catatan_tambahan,
        ]);

        return redirect()->route('tempahan.senarai')->with('success', 'Tempahan berjaya ditambah.');
    }

    // Kemaskini tempahan sedia ada
    public function update(Request $request, $id)
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

        $tempahan = Tempahan::findOrFail($id);
        $tempahan->update([
            'nama_pelanggan' => $request->nama_pelanggan,
            'alamat' => $request->alamat,
            'nombor_telefon' => $request->nombor_telefon,
            'jenis_tempahan' => $request->jenis_tempahan,
            'tarikh_tempahan' => $request->tarikh_tempahan,
            'chest_size' => $request->ukuran_dada,
            'waist_size' => $request->ukuran_pinggang,
            'shoulder_width' => $request->lebar_bahu,
            'sleeve_length' => $request->panjang_lengan,
            'jenis_kain' => $request->jenis_kain,
            'warna_kain' => $request->warna_kain,
            'size' => $request->saiz,
            'harga_tempahan' => $request->harga_tempahan,
            'additional_notes' => $request->catatan_tambahan,
        ]);

        return redirect()->route('tempahan.senarai')->with('success', 'Tempahan berjaya dikemaskini.');
    }

    // Papar borang kemaskini
    public function edit($id)
    {
        $tempahan = Tempahan::findOrFail($id);
        return view('admin.tempahan.edit-tempahan', compact('tempahan'));
    }

    // Hapus tempahan
    public function destroy($id)
    {
        $tempahan = Tempahan::findOrFail($id);
        $tempahan->delete();

        return redirect()->route('tempahan.senarai')->with('success', 'Tempahan berjaya dipadam.');
    }

    // Hantar data pelanggan untuk autofill borang tempahan baru
    public function getPelanggan($id)
    {
        $tempahan = Tempahan::findOrFail($id);
        return response()->json($tempahan);
    }
}
