<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TempahanController extends Controller
{
    public function senarai()
    {
        $tempahan = [
            (object)[
                'id' => 1,
                'nama_pelanggan' => 'Ali Bin Abu',
                'jenis_tempahan' => 'Baju Kurung',
                'tarikh_tempahan' => '2023-10-01'
            ],
            (object)[
                'id' => 2,
                'nama_pelanggan' => 'Siti Binti Ahmad',
                'jenis_tempahan' => 'Baju Melayu',
                'tarikh_tempahan' => '2023-10-02'
            ],
            (object)[
                'id' => 3,
                'nama_pelanggan' => 'Ahmad Bin Ali',
                'jenis_tempahan' => 'Kebaya',
                'tarikh_tempahan' => '2023-10-03'
            ]
        ];
        return view('admin.tempahan.senarai', ['tempahan' => $tempahan]);
    }

    public function baru()
    {
        // Your logic for the 'baru' route
        return view('admin.tempahan.borang-tempahan');
    }

    public function edit($id)
    {
        // Fetch the item by its ID
        // $item = Tempahan::findOrFail($id);
        $item = [
            (object)[
                'id' => 1,
                'nama_pelanggan' => 'Ali Bin Abu',
                'jenis_tempahan' => 'Baju Kurung',
                'tarikh_tempahan' => '2023-10-01'
            ]]; // Sample data for demonstration

        // Pass the item to the edit view
        return view('admin.tempahan.edit', compact('item'));
    }

    // In TempahanController.php
    public function destroy($id)
    {
        // $tempahan = Tempahan::findOrFail($id);
        // $tempahan->delete();

        return redirect()->route('tempahan.index')->with('success', 'Tempahan deleted successfully.');
    }
}