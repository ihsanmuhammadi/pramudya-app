<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengiriman;
use App\Models\Order;
use App\DataTables\PengirimanDataTable;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class PengirimanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PengirimanDataTable $dataTable)
    {
        return $dataTable->render('pengiriman');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengiriman $pengiriman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pengiriman = Pengiriman::with('order')->findOrFail($id);
        return response()->json($pengiriman);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Menunggu,Perjalanan,Diterima',
        ]);

        $pengiriman = Pengiriman::findOrFail($id);
        $pengiriman->update([
            'status' => $request->status,
        ]);

        return redirect()->route('pengiriman.index')->with('success', 'Status pengiriman berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pengiriman = Pengiriman::find($id);

        if (!$pengiriman) {
            return response()->json(['message' => 'Data tidak ditemukan.'], 404);
        }

        try {
            $pengiriman->delete();
            return response()->json(['message' => 'Data pengiriman berhasil dihapus.']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal menghapus data.'], 500);
        }
    }

    public function exportPdf()
    {
        $pengiriman = Pengiriman::with('order')->get();
        $pdf = Pdf::loadView('pengiriman.pdf-pengiriman', compact('pengiriman'));
        return $pdf->download('pengiriman_' . now()->format('Ymd_His') . '.pdf');
    }

    public function exportExcel()
{
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->fromArray([
        ['No', 'No Surat Jalan', 'No PO', 'Tanggal', 'Penerima', 'Status']
    ]);

    $pengiriman = Pengiriman::with('order')->get();
    $row = 2;
    foreach ($pengiriman as $index => $item) {
        $sheet->fromArray([
            $index + 1,
            $item->no_surat ?? '-',
            $item->order->no_po ?? '-',
            $item->order->tanggal ?? '-',
            $item->order->penerima ?? '-',
            $item->status ?? '-',
        ], null, "A$row");
        $row++;
    }

    $fileName = 'pengiriman_' . now()->format('Ymd_His') . '.xlsx';
    $writer = new Xlsx($spreadsheet);
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header("Content-Disposition: attachment; filename=\"$fileName\"");
    header('Cache-Control: max-age=0');
    $writer->save('php://output');
    exit;
}

public function exportCsv()
{
    $filename = 'pengiriman_' . now()->format('Ymd_His') . '.csv';
    $pengiriman = Pengiriman::with('order')->get();

    $headers = [
        "Content-type" => "text/csv",
        "Content-Disposition" => "attachment; filename=$filename",
    ];

    $callback = function () use ($pengiriman) {
        $handle = fopen('php://output', 'w');
        fputcsv($handle, ['No', 'No Surat Jalan', 'No PO', 'Tanggal', 'Penerima', 'Status']);

        foreach ($pengiriman as $index => $item) {
            fputcsv($handle, [
                $index + 1,
                $item->no_surat ?? '-',
                $item->order->no_po ?? '-',
                $item->order->tanggal ?? '-',
                $item->order->penerima ?? '-',
                $item->status ?? '-',
            ]);
        }

        fclose($handle);
    };

    return response()->stream($callback, 200, $headers);
}


}
