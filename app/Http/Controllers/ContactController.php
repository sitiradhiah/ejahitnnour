<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AduanCadangan;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        // Save the data in the 'AduanCadangan' table
        AduanCadangan::create([
            'nama_pelanggan' => $request->name,
            'tajuk' => 'Hubungi Kami', // or a custom title
            'kategori' => 'Aduan',  // Or use 'Cadangan' if it's a suggestion
            'tarikh' => now(),
            'status' => 'Menunggu',  // Set to "Menunggu" by default
            'message' => $request->message,
        ]);

        // Redirect to a thank you page or back to the form with success
        return redirect()->back()->with('success', 'Mesej berjaya dihantar!');
    }
}