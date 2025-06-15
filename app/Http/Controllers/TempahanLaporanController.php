<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tempahan;
use Illuminate\Support\Facades\DB;

class TempahanLaporanController extends Controller
{
    public function index()
    {
        $currentYear = now()->year;

        $tempahan = Tempahan::query()
            ->leftJoin('invoicetempahan', 'tempahans.id', '=', 'invoicetempahan.idtempahan')
            ->select(
                'tempahans.*',
                'invoicetempahan.tarikh as invoice_tarikh',
                'invoicetempahan.catatan',
                'invoicetempahan.hargaPerTempahan'
            )
            ->where('tempahans.status', '!=', 'pra-tempahan')
            ->orderBy('tempahans.tarikh_tempahan', 'desc')
            ->get();

        // Total harga for current year only, excluding 'pra-tempahan'
        $totalHarga = DB::table('tempahans')
            ->join('invoicetempahan', 'tempahans.id', '=', 'invoicetempahan.idtempahan')
            ->whereYear('tempahans.tarikh_tempahan', $currentYear)
            ->where('tempahans.status', '!=', 'pra-tempahan')
            ->sum('invoicetempahan.hargaPerTempahan');

        return view('admin.tempahan.laporan.senarai', compact('tempahan', 'totalHarga'));
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
        $query = Tempahan::query()
            ->leftJoin('invoicetempahan', 'tempahans.id', '=', 'invoicetempahan.idtempahan')
            ->select(
                'tempahans.*',
                'invoicetempahan.tarikh as invoice_tarikh',
                'invoicetempahan.catatan',
                'invoicetempahan.hargaPerTempahan'
            );

        if ($request->tarikh_dari) {
            $query->whereDate('tempahans.tarikh_tempahan', '>=', $request->tarikh_dari);
        }

        if ($request->tarikh_hingga) {
            $query->whereDate('tempahans.tarikh_tempahan', '<=', $request->tarikh_hingga);
        }

        if ($request->status) {
            $query->where('tempahans.status', $request->status);
        }

        $filteredData = $query->get();

        $totalHarga = $filteredData->sum('hargaPerTempahan');

        return response()->json([
            'data' => $filteredData,
            'totalHarga' => number_format($totalHarga, 2)
        ]);
    }


}
