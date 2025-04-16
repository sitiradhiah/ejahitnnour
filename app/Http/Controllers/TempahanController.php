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
        // Validate the incoming request data
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'jenis_tempahan' => 'required|string|max:255',
            'tarikh_tempahan' => 'required|date',
        ]);

        // Create a new tempahan record
        Tempahan::create([
            'nama_pelanggan' => $request->nama_pelanggan,
            'jenis_tempahan' => $request->jenis_tempahan,
            'tarikh_tempahan' => $request->tarikh_tempahan,
        ]);

        // Redirect back with a success message
        return redirect()->route('tempahan.senarai')->with('success', 'Tempahan added successfully!');
    }

    public function destroy($id)
    {
        // Find and delete the tempahan record
        $tempahan = Tempahan::findOrFail($id);
        $tempahan->delete();

        return redirect()->route('tempahan.senarai')->with('success', 'Tempahan deleted successfully.');
    }
}
