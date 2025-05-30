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
        $pelanggan = Tempahan::find($id);
        if (!$pelanggan) {
            return response()->json([], 404);
        }
    
        return response()->json([
            'nama_pelanggan' => $pelanggan->nama_pelanggan,
            'nombor_telefon' => $pelanggan->nombor_telefon,
            'alamat' => $pelanggan->alamat,
            'jenis_tempahan' => $pelanggan->jenis_tempahan,
            'tarikh_tempahan' => $pelanggan->tarikh_tempahan,
            'chest_size' => $pelanggan->chest_size,
            'waist_size' => $pelanggan->waist_size,
            'shoulder_width' => $pelanggan->shoulder_width,
            'sleeve_length' => $pelanggan->sleeve_length,
            'jenis_kain' => $pelanggan->jenis_kain,
            'warna_kain' => $pelanggan->warna_kain,
            'size' => $pelanggan->size,
            'harga_tempahan' => $pelanggan->harga_tempahan,
            'additional_notes' => $pelanggan->additional_notes,
        ]);
        
    }

    public function semakanPesananDashboard(Request $request)
    {
        $query = $request->input('query');
        $tempahan = Tempahan::where('nama_pelanggan', 'LIKE', "%{$query}%")
                            ->orWhere('nombor_telefon', 'LIKE', "%{$query}%")
                            ->get();

        // Jika permintaan adalah AJAX, kembalikan hanya bahagian status tempahan
        if ($request->ajax()) {
            return view('admin.tempahan.status-tempahan', compact('tempahan'));
        }

        // Betulkan path view kepada 'admin.tempahan.semakan-pesanan'
        return view('admin.tempahan.semakan-pesanan', compact('tempahan'));
    }


    // Kemaskini status tempahan
    public function updateStatus(Request $request, $id)
    {
        $tempahan = Tempahan::findOrFail($id);
    
        // Validate status yang dipilih
        $request->validate([
            'status' => 'required|string|in:Dalam Pelaksanaan,Sudah Selesai',
        ]);
    
        // Kemaskini status tempahan
        $tempahan->status = $request->status;
        $tempahan->save();
    
        // Kembalikan status untuk dikemaskini dalam halaman
        return response()->json([
            'status' => $tempahan->status,  // Kembalikan status yang dikemas kini
            'success' => 'Status tempahan berjaya dikemaskini.'
        ]);
    }
    




    
    // Semakan Pesanan berdasarkan nama atau nombor telefon untuk permintaan AJAX
    public function semakanPesanan(Request $request)
    {
        // Dapatkan input carian dari pengguna
        $query = $request->input('query');
        
        // Cari tempahan berdasarkan nama atau nombor telefon
        $tempahan = Tempahan::where('nama_pelanggan', 'LIKE', "%{$query}%")
                            ->orWhere('nombor_telefon', 'LIKE', "%{$query}%")
                            ->get();

        // Jika permintaan adalah AJAX, kembalikan hanya bahagian status tempahan
        if ($request->ajax()) {
            return view('admin.tempahan.status-tempahan', compact('tempahan'));
        }

        // Jika bukan AJAX, kembalikan view penuh
        return view('index', compact('tempahan'));
    }


}
