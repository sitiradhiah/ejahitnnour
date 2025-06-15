<?php

namespace App\Http\Controllers;

use App\Models\User; // Pastikan model User digunakan
use Illuminate\Http\Request;
use App\Models\Tempahan;

class PelangganController extends Controller
{
    // Menampilkan senarai pekerja
    public function index()
    {
        // Ambil semua pekerja yang mempunyai peranan 'pekerja'
        // $Customers = User::where('peranan', 'pelanggan')->get();

        // // Pastikan data pekerja dihantar ke view
        // return view('admin.maklumatsistem.senarai-pelanggan', compact('Customers'));

        // Ambil hanya pengguna yang berperanan 'pelanggan'
        $pelanggan = User::where('peranan', 'pelanggan')->get();

        // Hantar ke view
        return view('admin.maklumatsistem.senarai-pelanggan', compact('pelanggan'));

        // $tempahan = Tempahan::all()->unique('nombor_telefon')->values();
        // return view('admin.maklumatsistem.senarai-pelanggan', compact('tempahan'));


    }

    // Fungsi untuk memaparkan borang edit pelanggan
    public function edit($id)
    {
        // Cari pelanggan berdasarkan ID
        $pelanggan = User::findOrFail($id);

        // Hantar data pelanggan ke view untuk diedit
        return view('admin.maklumatsistem.senarai-pelanggan_edit', compact('pelanggan'));
    }

    // Fungsi untuk mengemaskini pelanggan
    public function update(Request $request, $id)
    {
        // dd($request->all());
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'phone' => 'required|string|max:15',
        ]);

        // Cari pelanggan berdasarkan ID
        $pelanggan = User::findOrFail($id);

        // Kemaskini data pelanggan
        $pelanggan->name = $request->input('name');
        $pelanggan->email = $request->input('email');
        $pelanggan->phone = $request->input('phone');

        // Simpan perubahan
        $pelanggan->save();

        // Redirect ke senarai pelanggan dengan mesej kejayaan
        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berjaya dikemaskini.');
    }

    // Fungsi untuk memadam pelanggan
    public function destroy($id)
    {
        // Cari pelanggan berdasarkan ID
        $pelanggan = User::findOrFail($id);

        // Padam pelanggan
        $pelanggan->delete();

        // Redirect ke senarai pelanggan dengan mesej kejayaan
        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berjaya dipadam.');
    }

}
