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
            'status' => 'pending',  // Status pekerja baru adalah 'pending' sehingga disahkan oleh admin
        ]);

        // Redirect kepada halaman log masuk dengan mesej
        return redirect()->route('login')->with('success', 'Pendaftaran berjaya. Sila tunggu pengesahan admin.');
    }
}

