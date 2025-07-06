<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class SuratJalanController extends Controller
{
    public function store(Request $request)
{
    $validated = $request->validate([
        'no_surat' => 'required',
        'tanggal' => 'required|date',
        'penerima' => 'required',
        'alamat_penerima' => 'required',
        'keterangan_penerima' => 'nullable',
        'no_po' => 'nullable',
        'kendaraan' => 'nullable',
        'detail_barang' => 'required'
    ]);

    $items = [];
    foreach(explode("\n", $validated['detail_barang']) as $line) {
        $parts = explode('|', $line);
        $items[] = [
            'qty' => $parts[0] ?? '',
            'nama_barang' => $parts[1] ?? '',
            'keterangan' => $parts[2] ?? ''
        ];
    }

    $pdf = Pdf::loadView('surat-jalan', array_merge($validated, ['items' => $items]));
    return $pdf->download('surat_jalan_'.$validated['no_surat'].'.pdf');
}



}
