<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Katelog;
use App\Models\User;

class PublicDataController extends Controller
{
    public function getDesignsByKategori(Request $request)
    {
        $kategori = $request->query('kategori');

        if (!$kategori) {
            return response()->json(['error' => 'Kategori tidak diberikan.'], 400);
        }

        $designs = Katelog::where('kategori', $kategori)
            ->pluck('nama');

        return response()->json($designs);
    }

    public function checkEmailExists(Request $request)
    {
        $user = \App\Models\User::where('email', $request->email)->first();

        return response()->json([
            'exists' => !!$user,
            'isWorker' => in_array(optional($user)->peranan, ['pekerja', 'pentadbir']),
        ]);
    }

    public function checkPhone(Request $request)
    {
        $user = \App\Models\User::where('phone', $request->phone)
        ->where('peranan', 'pelanggan')
        ->first();

        if ($user) {
            return response()->json([
                'exists' => true,
                'name' => $user->name,
                'email' => $user->email
            ]);
        }

        return response()->json(['exists' => false]);
    }
}
