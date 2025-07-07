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

        return view('generate', compact('orders'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|uuid|exists:orders,id',
            'no_surat' => 'required',
            'tanggal' => 'required|date',
            'penerima' => 'required',
            'alamat_penerima' => 'required',
            'keterangan_penerima' => 'nullable',
            'kendaraan' => 'nullable',
        ]);

        // Ambil data order dan relasi item + barang
        $order = Order::with(['items.goods'])->findOrFail($validated['order_id']);

        // Bangun array items untuk PDF
        $items = $order->items->map(function ($item) {
            return [
                'qty' => $item->jumlah_barang,
                'nama_barang' => $item->goods->nama_barang ?? '-',
                'keterangan' => '-', // Jika ada keterangan di item, bisa isi di sini
            ];
        })->toArray();

        $pdf = Pdf::loadView('surat-jalan', [
            'no_surat' => $validated['no_surat'],
            'tanggal' => $validated['tanggal'],
            'penerima' => $validated['penerima'],
            'alamat_penerima' => $validated['alamat_penerima'],
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
            'penerima' => $validated['penerima'],
            'status' => 'Menunggu',
        ]);

        return $pdf->download('surat_jalan_' . $validated['no_surat'] . '.pdf');
    }
}
