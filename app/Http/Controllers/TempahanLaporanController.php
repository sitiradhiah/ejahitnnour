<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tempahan;

class TempahanLaporanController extends Controller
{
    public function index()
    {
        $tempahan = Tempahan::orderBy('tarikh_tempahan', 'desc')->get();
        return view('admin.tempahan.laporan.senarai', compact('tempahan'));
    }

    public function show($id)
    {
        // Example: Show a specific tempahan report
        // $tempahan = Tempahan::findOrFail($id);
        // return view('tempahan_laporan.show', compact('tempahan'));

         return view('admin.tempahan.laporan.pdf'); // use your view file here
    }
}
