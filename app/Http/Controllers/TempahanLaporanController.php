<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tempahan;
use Illuminate\Support\Facades\DB;

class TempahanLaporanController extends Controller
{
    public function index()
    {
        $tempahan = Tempahan::query()
            ->leftJoin('invoicetempahan', 'tempahans.id', '=', 'invoicetempahan.idtempahan')
            ->select(
                'tempahans.*',
                'invoicetempahan.tarikh as invoice_tarikh',
                'invoicetempahan.catatan',
                'invoicetempahan.hargaPerTempahan'
            )
            ->orderBy('tempahans.tarikh_tempahan', 'desc')
            ->get();

        return view('admin.tempahan.laporan.senarai', compact('tempahan'));
    }

    public function show($id)
    {
        // Example: Show a specific tempahan report
        // $tempahan = Tempahan::findOrFail($id);
        // return view('tempahan_laporan.show', compact('tempahan'));

         return view('admin.tempahan.laporan.pdf'); // use your view file here
    }

    public function filter(Request $request)
    {
        $query = \App\Models\Tempahan::query();

        if ($request->tarikh_dari) {
            $query->whereDate('tarikh_tempahan', '>=', $request->tarikh_dari);
        }

        if ($request->tarikh_hingga) {
            $query->whereDate('tarikh_tempahan', '<=', $request->tarikh_hingga);
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        return response()->json($query->get());
    }

}
