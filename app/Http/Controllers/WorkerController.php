<?php

namespace App\Http\Controllers;

use App\Models\User; // Pastikan model User digunakan
use Illuminate\Http\Request;

class WorkerController extends Controller
{
    // Menampilkan senarai pekerja
    public function index()
    {
        // Ambil semua pekerja yang mempunyai peranan 'pekerja'
        $workers = User::where('peranan', '!=', 'pelanggan')->get();

        // Pastikan data pekerja dihantar ke view
        return view('admin.maklumatsistem.senaraipekerja', compact('workers'));
    }

    // Halaman untuk menambah pekerja baru
    public function create()
    {
        // Papar borang untuk menambah pekerja baru
        return view('admin.maklumatsistem.create');
    }

    // Proses menambah pekerja baru ke dalam database
    public function store(Request $request)
    {
        // Validasi input daripada borang
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users', // Pastikan email tidak berulang
            'password' => 'required|string|min:8|confirmed', // Pastikan kata laluan panjang dan disahkan
        ]);

        // Menyimpan pekerja baru
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Enkripsi kata laluan
            'peranan' => 'pekerja', // Tetapkan peranan pekerja
        ]);

        // Redirect ke halaman senarai pekerja dengan mesej kejayaan
        return redirect()->route('pekerja.index')->with('success', 'Pekerja berjaya ditambah.');
    }

    // Halaman untuk mengedit pekerja
    public function edit($id)
    {
        // Cari pekerja berdasarkan ID
        $worker = User::findOrFail($id);

        // Paparkan borang edit pekerja
        return view('admin.maklumatsistem.senaraipekerja_edit', compact('worker'));

    }

    // Proses kemaskini maklumat pekerja
    public function update(Request $request, $id)
    {
        // Validasi input daripada borang
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id, // Pastikan email unik kecuali untuk pekerja itu sendiri
            'password' => 'nullable|string|min:8|confirmed', // Kata laluan tidak wajib
            'phone' => 'nullable|string|max:15', // Nombor telefon tidak wajib
            'status' => 'nullable|string|max:255', // Status mesti sama ada 'aktif' atau 'tidak aktif'
            'peranan' => 'nullable|in:pekerja,admin', // Peranan mesti sama ada 'pekerja' atau 'admin'
            'disahkan' => 'nullable|boolean',
        ]);

        // Cari pekerja berdasarkan ID
        $worker = User::findOrFail($id);

        // Kemas kini pekerja
        $worker->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => $request->password ? bcrypt($request->password) : $worker->password, // Kemas kini kata laluan jika ada, jika tidak kekalkan lama
            'disahkan' => $request->has('disahkan') ? true : false, // Tetapkan disahkan jika checkbox ditanda
            'status' => $request->status, // Kemas kini status pekerja
            'peranan' => $request->peranan, // Kemas kini peranan pekerja
        ]);

        // Redirect ke senarai pekerja dengan mesej kejayaan
        return redirect()->route('senarai-pekerja.index')->with('success', 'Pekerja berjaya dikemas kini.');
    }

    // Proses memadam pekerja
    public function destroy($id)
    {
        // Cari pekerja berdasarkan ID
        $worker = User::findOrFail($id);

        // Padam pekerja
        $worker->delete();

        // Redirect ke senarai pekerja dengan mesej kejayaan
        return redirect()->route('senarai-pekerja.index')->with('success', 'Pekerja berjaya dipadam.');
    }
}
