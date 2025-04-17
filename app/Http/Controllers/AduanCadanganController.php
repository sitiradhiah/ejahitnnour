<?php

namespace App\Http\Controllers;

use App\Models\AduanCadangan; // Ensure you import the model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AduanCadanganController extends Controller
{
    /**
     * Function untuk ADMIN / CMS
     */
    public function index()
    {
        // Fetch all AduanCadangan records
        $aduans = AduanCadangan::all();  // You can filter or paginate the results if needed

        // Pass the data to the view
        return view('admin.aduan', compact('aduans'));
    }


    /**
     * Function untuk UMUM
     */
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

