<?php

namespace App\Http\Controllers;

use App\Models\Order; // Pastikan model Order ada
use App\Models\AduanCadangan; // Dari inquriy default ubah ke aduancadangan
use Illuminate\Http\Request;
use App\Models\Tempahan;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalOrders = Tempahan::whereYear('tarikh_tempahan', 2025)->count();

        // Breakdown by status for pie chart
        $praTempahan = Tempahan::whereYear('tarikh_tempahan', 2025)->where('status', 'Pra-tempahan')->count();
        $tempahanBaru = Tempahan::whereYear('tarikh_tempahan', 2025)->where('status', 'Tempahan Baru')->count();
        $dalamPelaksanaan = Tempahan::whereYear('tarikh_tempahan', 2025)->where('status', 'Dalam Pelaksanaan')->count();
        $sudahSelesai = Tempahan::whereYear('tarikh_tempahan', 2025)->where('status', 'Sudah Selesai')->count();

        $completedSales = Tempahan::whereYear('tarikh_tempahan', 2025)
            ->where('status', 'Sudah Selesai')
            ->sum('harga_tempahan');

        $ordersInProgress = Tempahan::whereYear('tarikh_tempahan', 2025)
            ->where('status', 'Dalam Pelaksanaan')
            ->count();

        $monthlyOrders = Tempahan::whereMonth('tarikh_tempahan', Carbon::now()->month)
            ->whereYear('tarikh_tempahan', 2025)
            ->count();

        $monthlyOrdersCompleted = [];
        $monthlyOrdersInProgress = [];

        for ($month = 1; $month <= 12; $month++) {
            $monthlyOrdersCompleted[] = Tempahan::whereYear('tarikh_tempahan', 2025)
                ->whereMonth('tarikh_tempahan', $month)
                ->where('status', 'Sudah Selesai')
                ->count();

            $monthlyOrdersInProgress[] = Tempahan::whereYear('tarikh_tempahan', 2025)
                ->whereMonth('tarikh_tempahan', $month)
                ->where('status', 'Dalam Pelaksanaan')
                ->count();
        }

        $latestInquiries = AduanCadangan::where('status', 'Menunggu')
        ->orderBy('tarikh', 'desc')
        ->take(5)
        ->get();


        return view('admin.Dashboard', compact(
            'totalOrders',
            'completedSales',
            'ordersInProgress',
            'monthlyOrders',
            'monthlyOrdersCompleted',
            'monthlyOrdersInProgress',
            'latestInquiries',
            'praTempahan',
            'tempahanBaru',
            'dalamPelaksanaan',
            'sudahSelesai'
        ));
    }
}
