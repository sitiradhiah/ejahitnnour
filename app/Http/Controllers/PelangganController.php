<?php

namespace App\Http\Controllers;

use App\Models\User; // Pastikan model User digunakan
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    // Menampilkan senarai pekerja
    public function index()
    {
        // Ambil semua pekerja yang mempunyai peranan 'pekerja'
        $Customers = User::where('peranan', 'pelanggan')->get();

        // Pastikan data pekerja dihantar ke view
        return view('admin.maklumatsistem.senarai-pelanggan', compact('Customers')); 
    }

}
