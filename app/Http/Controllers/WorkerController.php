<?php

namespace App\Http\Controllers;

use App\Models\User; // Pastikan model User digunakan
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;

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
            'phone' => 'nullable|string|max:15', // Nombor telefon tidak wajib, maksimum 15 aksara
            'peranan' => 'required|in:pekerja,pentadbir', // Peranan wajib dan mesti sama ada 'pekerja' atau 'pentadbir'
        ]);

        // Menyimpan pekerja baru
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Enkripsi kata laluan
            'peranan' => $request->peranan, // Tetapkan peranan pekerja
            'phone' => $request->phone ?? null,
            'status' => 'tidak aktif',
            'disahkan' => 0,
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
        // dd($request->all()); // Debugging: Semak data yang diterima
        // Validasi input daripada borang
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id, // Pastikan email unik kecuali untuk pekerja itu sendiri
            'password' => 'nullable|string|min:8|confirmed', // Kata laluan tidak wajib
            'phone' => 'nullable|string|max:15', // Nombor telefon tidak wajib
            'status' => 'nullable|string|max:255', // Status mesti sama ada 'aktif' atau 'tidak aktif'
            'peranan' => 'nullable|in:pekerja,pentadbir,pelanggan', // Peranan mesti sama ada 'pekerja' atau 'admin'
            // 'disahkan' => 'nullable|boolean',
        ]);

        // Cari pekerja berdasarkan ID
        $worker = User::findOrFail($id);

        // Jika peranan asal adalah 'pentadbir' dan ingin tukar ke selain 'pentadbir'
        if (
            $worker->peranan === 'pentadbir' &&
            $request->peranan !== 'pentadbir'
        ) {
            // Kira bilangan pentadbir yang status 'aktif' dan 'disahkan' = 1
            $adminCount = User::where('peranan', 'pentadbir')
            ->where('status', 'aktif')
            ->where('disahkan', 1)
            ->count();

            // Jika hanya ada satu pentadbir aktif dan disahkan, halang perubahan
            if ($adminCount <= 1) {
            return back()->with('error', 'Tidak boleh menukar peranan kerana sekurang-kurangnya satu pentadbir yang aktif dan disahkan diperlukan.');
            }
        }

        // Kemas kini pekerja
        $worker->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => $request->password ? bcrypt($request->password) : $worker->password,
            'status' => $request->status,
            'peranan' => $request->peranan,
        ]);

        // Jika peranan berubah, paksa logout pada permintaan seterusnya
        if ($worker->wasChanged('peranan')) {
            \Cache::put('peranan_version_' . $worker->id, now()->timestamp);
        }

        // Redirect ke senarai pekerja dengan mesej kejayaan
        return redirect()->route('senarai-pekerja.index')->with('success', 'Pengguna berdaftar berjaya dikemas kini.');
    }

    public function toggleDisahkan($id)
    {
        // Halang pengguna daripada menukar status sendiri
        if (auth()->id() == $id) {
            return back()->with('error', 'Anda tidak boleh menukar status pengesahan sendiri.');
        }

        $user = User::findOrFail($id);
        $user->disahkan = !$user->disahkan;
        // Jika disahkan menjadi true, tukar status kepada 'aktif'
        if ($user->disahkan) {
            // $user->status = 'aktif';
        } else {
            $user->status = 'tidak aktif';
        }
        $user->save();

        // Hantar emel kepada pengguna selepas status disahkan ditukar
        try {
            Mail::raw(
            "Maklumat ini adalah auto-dijana oleh sistem sebagai pemberitahuan bahawa akaun anda, {$user->name} ({$user->phone}), telah " .
            ($user->disahkan ? 'disahkan.' : 'dibuang pengesahannya.') .
            " Status semasa adalah " . ($user->status ?? 'Tidak diketahui') . ".",
            function ($message) use ($user) {
                $message->to($user->email)
                    ->subject("Notifikasi Pengesahan Akaun Pengguna Sistem Kedai Jahit N'Nour");
            }
            );
        } catch (\Exception $e) {
            // Log error jika perlu, atau berikan mesej ralat
            // Log::error('Mail error: ' . $e->getMessage());
            return back()->with('error', 'Berjaya di kemaskini tetapi gagal menghantar emel notifikasi.');
        }

        return back()->with('message', 'Status pengesahan pengguna telah dikemas kini.');
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
