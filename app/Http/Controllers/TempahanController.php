<?php

namespace App\Http\Controllers;

use App\Models\Katelog;
use Illuminate\Http\Request;
use App\Models\Tempahan;
use App\Models\User;

class TempahanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['semakanPesanan', 'praTempahanSubmit']);
    }

    // ✅ Untuk pengguna awam (tanpa login)
    public function praTempahanSubmit(Request $request)
    {
        // dd($request->all());


        // Semak jika nombor_telefon sudah wujud dalam jadual users
        $user = User::where('phone', $request->nombor_telefon)->first();

        if (!$user) {
            $user = User::create([
            'name' => $request->nama_pelanggan,
            'email' => $request->email, // Pastikan field email dihantar dari form
            'phone' => $request->nombor_telefon,
            'status' => 'tidak aktif',
            'level' => '3',
            'peranan' => 'pelanggan', // Set peranan sebagai pelanggan
            'password' => bcrypt('defaultpassword'),
            ]);

            $user->peranan = 'pelanggan';
            $user->save();
        }
        else {
            // Jika pengguna sudah wujud, kemas kini nama dan peranan
            $user->peranan = 'pelanggan'; // Pastikan peranan pelanggan
            $user->save();
        }

        Tempahan::create([
            'nama_pelanggan' => $request->nama_pelanggan,
            'nombor_telefon' => $request->nombor_telefon,
            'alamat' => $request->alamat, // optional
            'jenis_tempahan' => $request->jenis_Kategori, //kategori tempahan
            'tarikh_tempahan' => now(),
            'additional_notes' => $request->catatan_tambahan, // optional
            'status' => 'Pra-tempahan',
            'idPelanggan' => $user->id, // Jika ada foreign key user_id pada tempahan
        ]);

        return redirect()->back()->with('success', 'Pra-tempahan berjaya dihantar. Sila tunggu pengesahan / panggilan dari pihak kami.');
    }

    public function getDesignsByKategori(Request $request)
    {
        $kategori = $request->query('kategori');
        $designs = Katelog::where('kategori', $kategori)
            ->pluck('nama'); // pastikan column ini wujud
        return response()->json($designs);
    }


    // ✅ Untuk admin yang log masuk
    public function senarai(Request $request)
    {
        $query = Tempahan::query();

        // Tapisan berdasarkan jenis tempahan
        if ($request->filled('jenis_tempahan')) {
            $query->where('jenis_tempahan', $request->jenis_tempahan);
        }

        // Tapisan berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Optional: kalau ada search
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama_pelanggan', 'like', '%' . $request->search . '%')
                //   ->orWhere('jenis_tempahan', 'like', '%' . $request->search . '%')
                //   ->orWhere('status', 'like', '%' . $request->search . '%')
                  ->orWhere('nombor_telefon', 'like', '%' . $request->search . '%');
            });
        }

        $tempahan = $query->latest()->paginate(10)->withQueryString(); // Pastikan withQueryString supaya filter kekal

        // Untuk populate pilihan dropdown jika perlu
        $jenisList = Tempahan::select('jenis_tempahan')->distinct()->pluck('jenis_tempahan');
        $statusList = Tempahan::select('status')->distinct()->pluck('status');
        return view('admin.tempahan.senarai',  compact('tempahan', 'jenisList', 'statusList'));
    }

    public function baru()
    {
        $tempahan = Tempahan::all();
        return view('admin.tempahan.borang-tempahan', compact('tempahan'));
    }

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

    public function edit($id)
    {
        $tempahan = Tempahan::findOrFail($id);
        return view('admin.tempahan.edit-tempahan', compact('tempahan'));
    }

    public function destroy($id)
    {
        $tempahan = Tempahan::findOrFail($id);
        $tempahan->delete();

        return redirect()->route('tempahan.senarai')->with('success', 'Tempahan berjaya dipadam.');
    }

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

    // ✅ Untuk admin yang log masuk
    public function semakanPesananDashboard(Request $request)
    {
        $query = $request->input('query');

        $tempahan = Tempahan::where('nama_pelanggan', 'LIKE', "%{$query}%")
                            ->orWhere('nombor_telefon', 'LIKE', "%{$query}%")
                            ->get();

        if ($request->ajax()) {
            return view('admin.tempahan.status-pesanan', compact('tempahan'));
        }

        return view('admin.tempahan.senarai-pesanan', compact('tempahan'));
    }

    // ✅ Untuk pengguna awam di index
    public function semakanPesanan(Request $request)
    {
        $query = $request->input('query');

        $tempahan = Tempahan::where('nama_pelanggan', 'LIKE', "%{$query}%")
                            ->orWhere('nombor_telefon', 'LIKE', "%{$query}%")
                            ->get();

        if ($request->ajax()) {
            return view('semakan.statusawam-pesanan', compact('tempahan'));
        }

        return view('semakan.semakan-pesanan', compact('tempahan'));
    }

    // ✅ AJAX update status dari admin
    public function updateStatus(Request $request, $id)
    {
        $tempahan = Tempahan::findOrFail($id);

        $request->validate([
            'status' => 'required|string|in:Dalam Pelaksanaan,Sudah Selesai',
        ]);

        $tempahan->status = $request->status;
        $tempahan->save();

        return response()->json([
            'status' => $tempahan->status,
            'success' => 'Status tempahan berjaya dikemaskini.'
        ]);
    }
}
