<?php

namespace App\Http\Controllers;

use App\Models\Order; // Pastikan model Order ada
use App\Models\Inquiry; // Pastikan model Inquiry ada
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil jumlah tempahan untuk tahun 2025
        $totalOrders = Order::whereYear('created_at', 2025)->count();

        // Ambil jumlah jualan yang siap (status 'completed')
        $completedSales = Order::where('status', 'completed')->whereYear('created_at', 2025)->sum('total_price');

        // Ambil jumlah tempahan dalam proses
        $ordersInProgress = Order::where('status', 'in-progress')->count();

        // Ambil jumlah tempahan untuk bulan Januari
        $monthlyOrders = Order::whereMonth('created_at', 1)->whereYear('created_at', 2025)->count();

        // Ambil data untuk setiap bulan (untuk carta)
        $monthlyOrdersCompleted = [];
        $monthlyOrdersInProgress = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthlyOrdersCompleted[] = Order::whereMonth('created_at', $i)->where('status', 'completed')->count();
            $monthlyOrdersInProgress[] = Order::whereMonth('created_at', $i)->where('status', 'in-progress')->count();
        }

        // Ambil pertanyaan terkini
        $latestInquiries = Inquiry::latest()->take(5)->get();

        // Hantar data ke view
        return view('admin.dashboard', compact('totalOrders', 'completedSales', 'ordersInProgress', 'monthlyOrders', 'monthlyOrdersCompleted', 'monthlyOrdersInProgress', 'latestInquiries'));

    }
}
