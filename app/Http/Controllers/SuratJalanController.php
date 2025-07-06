<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class SuratJalanController extends Controller
{
    public function store(Request $request) {
    $validated = $request->validate([
        'no_surat_jalan' => 'required',
        'tanggal' => 'required|date',
        'customer_name' => 'required',
        'alamat_kirim' => 'required',
        'detail_barang' => 'required',
    ]);

    $items = [];
    foreach (explode("\n", $validated['detail_barang']) as $line) {
        $line = trim($line);
        if (!$line) continue;

        preg_match('/(.*)\((.*)\)/', $line, $matches);
        $nama_barang = isset($matches[1]) ? trim($matches[1], '- ') : $line;
        $qty = isset($matches[2]) ? $matches[2] : '';
        $items[] = [
            'qty' => $qty,
            'keterangan' => '-',
            'nama_barang' => $nama_barang
        ];
    }

    $pdf = Pdf::loadView('surat-jalan', [
        'tanggal' => $validated['tanggal'],
        'penerima' => $validated['customer_name'],
        'alamat_penerima' => $validated['alamat_kirim'],
        'no_surat' => $validated['no_surat_jalan'],
        'items' => $items
    ])->setPaper('A5', 'landscape');

    return $pdf->download('surat_jalan_'.$validated['no_surat_jalan'].'.pdf');
}


}
