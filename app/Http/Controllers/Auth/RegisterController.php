<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\UserUpdatedNotification;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('daftarmasuk');
    }

    public function register(Request $request)
    {
        // Validasi input dari borang
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Menyimpan data pekerja baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'status' => 'tidak aktif',  // Status pekerja baru adalah 'pending' sehingga disahkan oleh admin
        ]);

        $adminEmails = User::where('peranan', 'pentadbir')->pluck('email')->toArray();

        // dd($adminEmails);
        if (!empty($adminEmails)) {
            \Mail::raw(
            "Pendaftaran pengguna baru telah diterima: {$request->name} ({$request->email}). Sila semak sistem untuk maklumat lanjut.",
            function ($message) use ($adminEmails) {
                $message->to($adminEmails)
                ->subject('Notifikasi Pra-Tempahan Baru');
            }
            );
        }

        // Redirect kepada halaman log masuk dengan mesej
        return redirect()->route('logmasuk')->with('success', 'Pendaftaran berjaya. Sila tunggu pengesahan admin.');
    }
}

