<?php

namespace App\Http\Controllers;

use App\Models\Pendapatan;
use App\DataTables\PendapatanDataTable;
use App\Models\Order;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Barryvdh\DomPDF\Facade\Pdf;

class PendapatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PendapatanDataTable $dataTable)
    {
        $orders = Order::doesntHave('pendapatan')->get(); // hanya order yang belum tercatat
        return $dataTable->render('pendapatan', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil order yang belum punya pendapatan
        $orders = Order::doesntHave('pendapatan')->get(['id', 'no_po', 'nama_po', 'tanggal', 'total_semua_barang']);

        if (request()->ajax()) {
            return view('pendapatan.create', compact('orders'));
        }

        return redirect()->route('pendapatan.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|uuid|exists:orders,id|unique:pendapatan,order_id',
        ]);

        Pendapatan::create([
            'order_id' => $validated['order_id'],
        ]);

        return response()->json(['success' => true, 'message' => 'Pendapatan berhasil dicatat.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pendapatan = Pendapatan::findOrFail($id);
        $pendapatan->delete();

        return redirect()->route('pendapatan.index')
            ->with('success', 'Data pendapatan berhasil dihapus.');
    }

    public function exportPdf()
    {
        $pendapatan = Pendapatan::with('order')->get();
        $pdf = Pdf::loadView('pendapatan.export.pdf', compact('pendapatan'));
        return $pdf->download('pendapatan_' . date('Y-m-d_H-i-s') . '.pdf');
    }

    public function exportExcel()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->fromArray([
            ['No', 'No PO', 'Nama PO', 'Tanggal Order', 'Total Pendapatan', 'Dicatat Pada']
        ]);

        $pendapatan = Pendapatan::with('order')->get();
        $row = 2;
        foreach ($pendapatan as $index => $item) {
            $sheet->fromArray([
                $index + 1,
                $item->order->no_po ?? '-',
                $item->order->nama_po ?? '-',
                $item->order->tanggal ?? '-',
                $item->order->total_semua_barang ?? 0,
                $item->created_at->format('Y-m-d H:i')
            ], null, "A$row");
            $row++;
        }

        $fileName = 'pendapatan_' . now()->format('Ymd_His') . '.xlsx';
        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$fileName\"");
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit;
    }

    public function exportCsv()
    {
        $filename = 'pendapatan.csv';
        $pendapatan = Pendapatan::with('order')->get();

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
        ];

        $callback = function () use ($pendapatan) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['No', 'No PO', 'Nama PO', 'Tanggal Order', 'Total Pendapatan', 'Dicatat Pada']);
            foreach ($pendapatan as $index => $item) {
                fputcsv($handle, [
                    $index + 1,
                    $item->order->no_po ?? '-',
                    $item->order->nama_po ?? '-',
                    $item->order->tanggal ?? '-',
                    $item->order->total_semua_barang ?? 0,
                    $item->created_at->format('Y-m-d H:i')
                ]);
            }
            fclose($handle);
        };
        return response()->stream($callback, 200, $headers);
    }
}
