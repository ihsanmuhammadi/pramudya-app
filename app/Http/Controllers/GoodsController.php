<?php

namespace App\Http\Controllers;

use App\Models\Goods;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Redirect;
use App\DataTables\GoodsDataTable;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class GoodsController extends Controller
{
     // Show create form
    // public function create(): View {
    //     return view('goods.create');
    // }

    // List goods
    public function index(GoodsDataTable $dataTable) {
        return $dataTable->render('goods');
    }

    // Store new department
    public function store(Request $request): JsonResponse {
        $validated = $request->validate([
            'nama_barang'   => 'required|string|max:255',
            'jumlah_barang' => 'required|integer|min:0',
            'satuan_barang' => 'required|string|max:255',
            'harga_barang'  => 'required|numeric|min:0',
            'kode_barang'   => 'required|string|unique:goods,kode_barang',
            'spesifikasi'   => 'nullable|string',
        ]);

        Goods::create($validated);

        return response()->json(['success' => true]);
    }

    // Show single goods by route model binding
    public function show(string $id) {
        $goods = Goods::findOrFail($id); // <-- fetch manually

        if (request()->ajax()) {
            return view('goods.show', compact('goods'));
        }

        return redirect()->route('goods.index');
    }



    // Edit form
    public function edit(string $id): View{
        $goods = Goods::findOrFail($id); // ← manually fetch the model

        if (request()->ajax()) {
            return view('goods.edit', compact('goods'));
        }

        return redirect()->route('goods.index');
    }

    // Update goods
    public function update(Request $request, string $id): RedirectResponse {
        $goods = Goods::findOrFail($id); // ⬅️ fetch manually using the ID

        $validated = $request->validate([
            'nama_barang'     => 'required|string|max:255',
            'jumlah_barang'   => 'required|integer|min:0',
            'satuan_barang'   => 'required|string|min:1',
            'harga_barang'    => 'required|numeric|min:0',
            'kode_barang'     => 'required|string|unique:goods,kode_barang,' . $id,
            'spesifikasi'     => 'nullable|string',
        ]);

        $goods->update($validated);

        return redirect()->route('goods.index')
            ->with('success', 'Data barang berhasil diperbarui.');
    }


    // Delete goods
    public function destroy(string $id): RedirectResponse {
        $goods = Goods::findOrFail($id);
        $goods->delete();

        return redirect()->route('goods.index')
            ->with('success', 'Data barang berhasil dihapus.');
    }

    // Export Excel
    public function exportExcel() {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set column headers
        $sheet->fromArray([
            ['Nama Barang', 'Jumlah', 'Satuan', 'Harga', 'Kode', 'Spesifikasi', 'Created At', 'Updated At']
        ]);

        // Fetch data and populate rows
        $goods = Goods::all();
        $row = 2;
        foreach ($goods as $item) {
            $sheet->fromArray([
                $item->nama_barang,
                $item->jumlah_barang,
                $item->satuan_barang,
                $item->harga_barang,
                $item->kode_barang,
                $item->spesifikasi,
                $item->created_at->format('Y-m-d H:i:s'),
                $item->updated_at->format('Y-m-d H:i:s')
            ], null, "A$row");
            $row++;
        }

        // Output to browser
        $fileName = 'goods_' . now()->format('Ymd_His') . '.xlsx';
        $writer = new Xlsx($spreadsheet);

        // Headers
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$fileName\"");
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }

    // Export PDF
    public function exportPdf() {
        $goods = Goods::all(); // or apply any filters you need

        $pdf = Pdf::loadView('goods.pdf-goods', compact('goods'));

        return $pdf->download('goods_' . date('Y-m-d_H-i-s') . '.pdf');
    }

    // Export CSV
    public function exportCSV() {
        $filename = 'goods.csv';
        $goods = Goods::all();

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
        ];

        $callback = function () use ($goods) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Nama', 'Jumlah', 'Satuan', 'Harga', 'Kode', 'Spesifikasi']);

            foreach ($goods as $item) {
                fputcsv($handle, [
                    $item->nama_barang,
                    $item->jumlah_barang,
                    $item->satuan_barang,
                    $item->harga_barang,
                    $item->kode_barang,
                    $item->spesifikasi
                ]);
            }
            fclose($handle);
        };
        return response()->stream($callback, 200, $headers);
    }
}
