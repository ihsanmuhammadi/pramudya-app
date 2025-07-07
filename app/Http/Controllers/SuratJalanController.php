<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Order;
use App\Models\Pengiriman;

class SuratJalanController extends Controller
{
    public function create()
    {
        $orders = Order::whereDoesntHave('pengiriman')
        ->get(['id', 'no_po', 'nama_po']);

        $histories = Pengiriman::with('order')
        ->latest()
        ->take(10)
        ->get();

        return view('generate', compact('orders', 'histories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|uuid|exists:orders,id',
            'no_surat' => 'required',
            'tanggal' => 'required|date',
            'keterangan_penerima' => 'nullable',
            'kendaraan' => 'nullable',
        ]);

        $order = Order::with(['items.goods'])->findOrFail($validated['order_id']);

        // Ambil nama & alamat penerima langsung dari order
        $penerima = $order->company ?? '-';
        $alamat_penerima = $order->alamat ?? '-';

        $items = $order->items->map(function ($item) {
            return [
                'qty' => $item->jumlah_barang,
                'nama_barang' => $item->goods->nama_barang ?? '-',
                'keterangan' => '-', // placeholder keterangan
            ];
        })->toArray();

        $pdf = Pdf::loadView('surat-jalan', [
            'no_surat' => $validated['no_surat'],
            'tanggal' => $validated['tanggal'],
            'penerima' => $penerima,
            'alamat_penerima' => $alamat_penerima,
            'keterangan_penerima' => $validated['keterangan_penerima'] ?? '',
            'no_po' => $order->no_po,
            'kendaraan' => $validated['kendaraan'],
            'items' => $items,
        ]);

        // Simpan pengiriman
        Pengiriman::create([
            'no_surat' => $validated['no_surat'],
            'order_id' => $request->order_id,
            'tanggal' => $validated['tanggal'],
            'penerima' => $penerima,
            'status' => 'Menunggu',
            'keterangan_penerima' => $validated['keterangan_penerima'],
            'kendaraan' => $validated['kendaraan']
        ]);

        return $pdf->download('surat_jalan_' . $validated['no_surat'] . '.pdf');
    }

    public function download($id)
    {
        $pengiriman = Pengiriman::with(['order.items.goods'])->findOrFail($id);
        $order = $pengiriman->order;

        $items = $order->items->map(function ($item) {
            return [
                'qty' => $item->jumlah_barang,
                'nama_barang' => $item->goods->nama_barang ?? '-',
                'keterangan' => '-', // atau sesuaikan jika ada kolomnya
            ];
        })->toArray();

        $pdf = Pdf::loadView('surat-jalan', [
            'no_surat' => $pengiriman->no_surat,
            'tanggal' => $pengiriman->tanggal,
            'penerima' => $pengiriman->penerima,
            'alamat_penerima' => $order->alamat ?? '-', // atau sesuaikan fieldnya
            'keterangan_penerima' => $pengiriman->keterangan_penerima ?? '-',
            'no_po' => $order->no_po,
            'kendaraan' => $pengiriman->kendaraan,
            'items' => $items,
        ]);

        return $pdf->download('surat_jalan_' . $pengiriman->no_surat . '.pdf');
    }

}
