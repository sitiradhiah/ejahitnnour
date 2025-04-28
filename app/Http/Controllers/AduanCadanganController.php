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
    public function index(Request $request)
    {
        $search = $request->input('search');

        $aduans = AduanCadangan::query()
            ->when($search, function ($query, $search) {
                $query->where('nama_pelanggan', 'like', "%{$search}%")
                    ->orWhere('tajuk', 'like', "%{$search}%")
                    ->orWhere('kategori', 'like', "%{$search}%")
                    ->orWhere('status', 'like', "%{$search}%");
            })
            ->orderBy('tarikh', 'desc')
            ->get();

        return view('admin.aduan', compact('aduans', 'search'));
    }



    /**
     * Function untuk UMUM
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'no_telefon' => 'required|string|max:255',
            'message' => 'required|string',
        ]);
    
        AduanCadangan::create([
            'nama_pelanggan' => $request->name,
            'email' => $request->email,
            'no_telefon' => $request->no_telefon,
            'tajuk' => 'Hubungi Kami',
            'kategori' => 'Aduan',
            'tarikh' => now(),
            'status' => 'Menunggu',
            'message' => $request->message,
        ]);
    
        return redirect()->back()->with('success', 'Mesej berjaya dihantar!');
    }

    public function preview($id)
    {
        $aduan = AduanCadangan::findOrFail($id);

        // Auto update status kepada "Selesai" kalau masih "Menunggu"
        if ($aduan->status == 'Menunggu') {
            $aduan->update(['status' => 'Selesai']);
        }

        return view('admin.aduan-preview', compact('aduan'));
    }

    public function destroy($id)
    {
        $aduan = AduanCadangan::findOrFail($id);
        $aduan->delete();

        return redirect()->route('aduan-cadangan.index')->with('success', 'Aduan / Cadangan berjaya dipadam.');
    }


}

