<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePengeluaranRequest;
use App\Http\Requests\UpdatePengeluaranRequest;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use App\DataTables\PengeluaranDataTable;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Barryvdh\DomPDF\Facade\Pdf;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PengeluaranDataTable $dataTable)
    {
        $pengeluaran = Pengeluaran::all();
        return $dataTable->render('pengeluaran');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_po' => 'required',
            'nama_po' => 'required',
            'tanggal' => 'required|date',
            'total' => 'required'
        ]);

        $pengeluaran = Pengeluaran::create([
            'no_po' => $validated['no_po'],
            'nama_po' => $validated['nama_po'],
            'tanggal' => $validated['tanggal'],
            'total' => $validated['total'],
            'keterangan' => $request->keterangan
        ]);

        return response()->json(['success' => true]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id);
        if (request()->ajax()) {
            return view('pengeluaran.show', compact('pengeluaran'));
        }
        return redirect()->route('pengeluaran.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id);
        if (request()->ajax()) {
            return view('pengeluaran.edit', compact('pengeluaran'));
        }
        return redirect()->route('pengeluaran.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
        'no_po' => 'required|string',
        'nama_po' => 'required|string',
        'tanggal' => 'required|date',
        'total' => 'required|numeric|min:0',
        'keterangan' => 'nullable|string'
        ]);

        $pengeluaran = Pengeluaran::findOrFail($id);
        $pengeluaran->update($validated);

        return redirect()->route('pengeluaran.index')
            ->with('success', 'Data pengeluaran berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id);
        $pengeluaran->delete();

        return redirect()->route('pengeluaran.index')
        ->with('success', 'Data pengeluaran berhasil dihapus.');
    }

    public function exportPdf() {
        $pengeluaran = Pengeluaran::select('no_po', 'nama_po', 'tanggal', 'total', 'keterangan')->get();
        $pdf = Pdf::loadView('pengeluaran.pdf-pengeluaran', compact('pengeluaran'));
        return $pdf->download('pengeluaran_' . now()->format('Y-m-d_H-i-s') . '.pdf');
    }

    public function exportExcel() {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->fromArray([
            ['No PO', 'Nama PO', 'Tanggal', 'Total', 'Keterangan']
        ]);

        $pengeluaran = Pengeluaran::select('no_po', 'nama_po', 'tanggal', 'total', 'keterangan')->get();
        $row = 2;
        foreach ($pengeluaran as $item) {
            $sheet->fromArray([
                $item->no_po,
                $item->nama_po,
                $item->tanggal,
                $item->total,
                $item->keterangan
            ], null, "A$row");
            $row++;
        }

        $fileName = 'pengeluaran_' . now()->format('Ymd_His') . '.xlsx';
        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$fileName\"");
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit;
    }

    public function exportCsv() {
        $filename = 'pengeluaran.csv';
        $pengeluaran = Pengeluaran::select('no_po', 'nama_po', 'tanggal', 'total', 'keterangan')->get();

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
        ];

        $callback = function () use ($pengeluaran) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['No PO', 'Nama PO', 'Tanggal', 'Total', 'Keterangan']);
            foreach ($pengeluaran as $item) {
                fputcsv($handle, [
                    $item->no_po,
                    $item->nama_po,
                    $item->tanggal,
                    $item->total,
                    $item->keterangan
                ]);
            }
            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

}
