<?php

namespace App\Http\Controllers;

use App\Models\AduanCadangan; // Ensure you import the model

class AduanCadanganController extends Controller
{
    public function index()
    {
        // Fetch all AduanCadangan records
        $aduans = AduanCadangan::all();  // You can filter or paginate the results if needed
        
        // Pass the data to the view
        return view('admin.aduan', compact('aduans'));
    }
}

