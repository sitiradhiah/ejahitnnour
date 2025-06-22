<?php

namespace App\Http\Controllers;

use App\Models\Katelog;
use Illuminate\Http\Request;
use App\Models\Tempahan;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class TempahanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['semakanPesanan', 'praTempahanSubmit']);
    }

    // ✅ Untuk pengguna awam (tanpa login)
    public function praTempahanSubmit(Request $request)
    {
        $request->validate([
            'nama_pelanggan'    => 'required|string|max:255',
            'nombor_telefon'    => 'required|string|max:20',
            'email'             => 'required|email|max:255',
            'alamat'            => 'nullable|string|max:255',
            'jenis_Kategori'    => 'required|string|max:255',
            'nama_design'       => 'nullable|string|max:255',
            'catatan'  => 'nullable|string|max:1000',
        ]);

        // ✅ Check if phone number exists
        $user = User::where('phone', $request->nombor_telefon)->first();

        if (!$user) {

            // Phone not found, create new user
            $user = User::create([
                'name'     => $request->nama_pelanggan,
                'email'    => $request->email,
                'phone'    => $request->nombor_telefon,
                'status'   => 'tidak aktif',
                'level'    => '3',
                'password' => bcrypt('defaultpassword'),
                'peranan'  => 'pelanggan',
            ]);
        } else {
            // Phone exists – update email if different
            if ($user->email !== $request->email) {
                $user->email = $request->email;
            }

            // (Optional) update name if different
            if ($user->name !== $request->nama_pelanggan) {
                $user->name = $request->nama_pelanggan;
            }

            $user->peranan = 'pelanggan';
            $user->save();
        }

        // 💾 Simpan tempahan
        $tempahan = Tempahan::create([
            'nama_pelanggan'    => $request->nama_pelanggan,
            'nombor_telefon'    => $request->nombor_telefon,
            'alamat'            => $request->alamat,
            'jenis_tempahan'    => $request->jenis_Kategori,
            'nama_design'       => $request->nama_design,
            'tarikh_tempahan'   => now(),
            'additional_notes'  => $request->catatan,
            'status'            => 'Pra-tempahan',
            'idPelanggan'       => $user->id,
        ]);

        // 💾 Simpan invoicetempahan
        \DB::table('invoicetempahan')->insert([
            'idTempahan'         => $tempahan->id,
            'tarikh'             => now(),
            'created_at'         => now(),
            'updated_at'         => now(),
            'hargaPerTempahan'   => 0,
            'catatan'            => 'Pra-tempahan dibuat oleh ' . $request->nama_pelanggan,
        ]);

        // ✉️ Hantar notifikasi kepada admin
        $adminEmails = User::where('peranan', 'pentadbir')->pluck('email')->toArray();
        $emailError = null;

        if (!empty($adminEmails)) {
            try {
                \Mail::raw(
                    "Pra-tempahan baru telah diterima daripada {$request->nama_pelanggan} ({$request->nombor_telefon}). Sila semak sistem untuk maklumat lanjut.",
                    function ($message) use ($adminEmails) {
                        $message->to($adminEmails)->subject('Notifikasi Pra-Tempahan Baru');
                    }
                );
            } catch (\Exception $e) {
                $emailError = 'Pra-tempahan berjaya tetapi notifikasi emel gagal dihantar.';
            }
        }

        return redirect()->route('homepage')->with([
            'success' => 'Pra-tempahan berjaya dihantar. Kami akan hubungi anda.',
            'email_error' => $emailError,
        ]);
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
        $query = Tempahan::with(['pekerja', 'user']);

        if ($request->filled('jenis_tempahan')) {
            $query->where('jenis_tempahan', $request->jenis_tempahan);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama_pelanggan', 'like', '%' . $request->search . '%')
                ->orWhere('nombor_telefon', 'like', '%' . $request->search . '%')
                ->orWhereHas('pekerja', function ($subQuery) use ($request) {
                    $subQuery->where('name', 'like', '%' . $request->search . '%');
                });
            });
        }


        $tempahan = $query->latest()->get(); // No paginate()

        $jenisList = Tempahan::select('jenis_tempahan')->distinct()->pluck('jenis_tempahan');
        $statusList = Tempahan::select('status')->distinct()->pluck('status');

        return view('admin.tempahan.senarai', compact('tempahan', 'jenisList', 'statusList'));
    }


    public function baru()
    {
        $tempahan = Tempahan::all();
        $users = User::all();
        $katelogs = Katelog::all();
        $pekerjas = User::whereIn('peranan', ['pekerja', 'pentadbir'])->get();
        return view('admin.tempahan.borang-tempahan', compact('tempahan', 'users', 'katelogs', 'pekerjas'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
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
            // 'saiz' => 'nullable|string',
            'harga_tempahan' => 'nullable|numeric',
            'catatan_tambahan' => 'nullable|string',
            'reka_bentuk' => 'nullable|string|max:255',
            'pekerja_bertugas' => 'required|in:0,1',
            'pekerja_id' => 'nullable|exists:users,id',
        ]);

        // Cari id pelanggan berdasarkan nombor_telefon (phone) dalam users table
        $user = User::where('phone', $request->nombor_telefon)->first();
        $idPelanggan = $user ? $user->id : null;

         $tempahan = Tempahan::create([
            'nama_pelanggan' => $request->nama_pelanggan,
            'alamat' => $request->alamat,
            'nombor_telefon' => $request->nombor_telefon,
            'jenis_tempahan' => $request->jenis_tempahan,
            'tarikh_tempahan' => $request->tarikh_tempahan,
            'chest_size' => $request->ukuran_dada,
            'nama_design' => $request->reka_bentuk,
            'waist_size' => $request->ukuran_pinggang,
            'shoulder_width' => $request->lebar_bahu,
            'sleeve_length' => $request->panjang_lengan,
            'jenis_kain' => $request->jenis_kain,
            'warna_kain' => $request->warna_kain,
            'status' => 'Tempahan Baru', // Status boleh diubah kemudian
            'harga_tempahan' => $request->harga_tempahan ?? 0,
            'additional_notes' => $request->catatan_tambahan,
            'idPekerja' => $request->pekerja_id ?? null,
            'idPelanggan' => $idPelanggan,
        ]);

        // Masukkan ke dalam jadual invoicetempahan
        \DB::table('invoicetempahan')->insert([
            'idTempahan' => $tempahan->id,
            'tarikh' => now(),
            'created_at' => now(),
            'updated_at' => now(),
            'hargaPerTempahan' =>  $request->harga_tempahan ?? 0, // Harga boleh diubah kemudian
            'catatan' => 'Pra-tempahan dibuat oleh ' . $request->nama_pelanggan,
            // Tambah field lain jika perlu
        ]);

        return redirect()->route('tempahan.senarai')->with('success', 'Tempahan berjaya ditambah.');
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
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
            // 'saiz' => 'nullable|string',
            'reka_bentuk' => 'nullable|string|max:255',
            'harga_tempahan' => 'nullable|numeric',
            'catatan_tambahan' => 'nullable|string',
            'pekerja_bertugas' => 'required|in:0,1',
            'pekerja_id' => 'nullable|exists:users,id',
        ]);

       if ($request->pekerja_bertugas == '1') {
            $idPekerja = auth()->id();
        } else {
            $idPekerja = $request->pekerja_id ?? null;
        }

        $tempahan = Tempahan::findOrFail($id);
        // Cari id pelanggan berdasarkan nombor_telefon (phone) dalam users table
        $user = User::where('phone', $request->nombor_telefon)->first();
        $idPelanggan = $user ? $user->id : null;

        $tempahan->update([
            'nama_pelanggan' => $request->nama_pelanggan,
            'alamat' => $request->alamat,
            'nombor_telefon' => $request->nombor_telefon,
            'jenis_tempahan' => $request->jenis_tempahan,
            'tarikh_tempahan' => $request->tarikh_tempahan,
            'chest_size' => $request->ukuran_dada,
            'nama_design' => $request->reka_bentuk,
            'waist_size' => $request->ukuran_pinggang,
            'shoulder_width' => $request->lebar_bahu,
            'sleeve_length' => $request->panjang_lengan,
            'jenis_kain' => $request->jenis_kain,
            'warna_kain' => $request->warna_kain,
            // 'size' => $request->saiz,
            'harga_tempahan' => $request->harga_tempahan ?? 0,
            'additional_notes' => $request->catatan_tambahan,
            'idPekerja' => $idPekerja,
            'idPelanggan' => $idPelanggan,
        ]);

        // Kemas kini invoicetempahan di mana idTempahan = $id
        \DB::table('invoicetempahan')
            ->where('idTempahan', $id)
            ->update([
            'hargaPerTempahan' =>  $request->harga_tempahan ?? 0,
            'catatan' => 'Tempahan dikemaskini oleh ' . $request->nama_pelanggan,
            'updated_at' => now(),
            ]);

        return redirect()->route('tempahan.senarai')->with('success', 'Tempahan berjaya dikemaskini.');
    }

    public function edit($id)
    {
        $tempahan = Tempahan::findOrFail($id);
        $users = User::all(); //
        $katelogs = Katelog::all(); // Juga pastikan katelogs dihantar
        $pekerjas = User::whereIn('peranan', ['pekerja', 'pentadbir'])->get();
        return view('admin.tempahan.edit-tempahan', compact('tempahan', 'users', 'katelogs','pekerjas'));

    }

    public function hantarStatusTempahan($id)
    {
        $tempahan = Tempahan::findOrFail($id);

        // Cari user berdasarkan nombor_telefon
        $user = User::where('phone', $tempahan->nombor_telefon)->first();

        if (!$user || !$user->email) {
            return back()->with('error', 'Emel pelanggan tidak dijumpai dalam rekod pengguna.');
        }

        $status = $tempahan->status ?? 'Tidak diketahui';

        // dd($status. ' ' . $user->email);
        Mail::raw("Assalamualaikum, status tempahan anda kini adalah {$status}\n\n---\nEmel ini dijana secara automatik oleh sistem eJahitNnour. Sila abaikan jika tidak berkaitan. Tidak perlu balas emel ini. Sekian terima kasih", function ($message) use ($user) {
            $message->to($user->email)
                    ->subject('Status Tempahan Anda');
        });

        return back()->with('success', "Status '{$status}' telah dihantar ke emel: {$user->email}");
    }

    public function destroy($id)
    {
        $tempahan = Tempahan::findOrFail($id);

         // Padam invois yang berkait
        \DB::table('invoicetempahan')->where('idTempahan', $tempahan->id)->delete();

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
            'status' => 'required|string',
        ]);

        $tempahan->status = $request->status;
        $tempahan->save();

        return response()->json([
            'status' => $tempahan->status,
            'success' => 'Status tempahan berjaya dikemaskini.'
        ]);
    }
}
