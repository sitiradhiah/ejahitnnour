<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Katelog;

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
}
