<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBarang = \App\Models\Goods::count();
        $totalOrder = \App\Models\Order::count();

        // Ambil total pendapatan dari order_items yang terkait dengan order_id di pendapatan
        $totalPendapatan = \App\Models\OrderItem::whereIn('order_id', function ($query) {
            $query->select('order_id')->from('pendapatan');
        })->sum('total_harga_barang');

        $pengeluaranTerbaru = \App\Models\Pengeluaran::latest()->take(5)->get();

        $pengirimanStats = \App\Models\Pengiriman::selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        return view('dashboard', compact(
            'totalBarang',
            'totalOrder',
            'totalPendapatan',
            'pengeluaranTerbaru',
            'pengirimanStats'
        ));
    }


}
