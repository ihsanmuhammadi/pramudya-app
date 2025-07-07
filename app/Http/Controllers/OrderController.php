<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Goods;
use Illuminate\Http\Request;
use App\DataTables\OrderDataTable;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{
    public function index(OrderDataTable $dataTable) {
        $goods = Goods::all();
        return $dataTable->render('orders', compact('goods'));
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'no_po' => 'required',
            'nama_po' => 'required',
            'tanggal' => 'required|date',
            'company' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'email' => 'required|email',
            'fax' => 'nullable',
            'pic' => 'required',
            'items' => 'required|array|min:1',
            'items' => 'nullable|array',
            'items.*.goods_id' => 'required_with:items.*|exists:goods,id',
            'items.*.jumlah_barang' => 'required_with:items.*|integer|min:1'
        ]);

        DB::transaction(function () use ($validated, $request) {
            $total_all = 0;
            if (!empty($validated['items'])) {
                foreach ($validated['items'] as $item) {
                    $goods = Goods::findOrFail($item['goods_id']);
                    if ($goods->jumlah_barang < $item['jumlah_barang']) {
                        throw ValidationException::withMessages([
                            'stok' => "Stok untuk {$goods->nama_barang} tidak mencukupi."
                        ]);
                    }
                    $total_all += $goods->harga_barang * $item['jumlah_barang'];
                }
            }


            $order = Order::create([
                'no_po' => $validated['no_po'],
                'nama_po' => $validated['nama_po'],
                'tanggal' => $validated['tanggal'],
                'company' => $validated['company'],
                'alamat' => $validated['alamat'],
                'no_telp' => $validated['no_telp'],
                'email' => $validated['email'],
                'fax' => $validated['fax'],
                'pic' => $validated['pic'],
                'total_semua_barang' => $total_all,
                'keterangan' => $request->keterangan
            ]);

            if (!empty($validated['items'])) {
                foreach ($validated['items'] as $item) {
                    $goods = Goods::find($item['goods_id']);
                    $goods->jumlah_barang -= $item['jumlah_barang'];
                    $goods->save();

                    $order->items()->create([
                        'goods_id' => $item['goods_id'],
                        'jumlah_barang' => $item['jumlah_barang'],
                        'harga_barang' => $goods->harga_barang,
                        'total_harga_barang' => $goods->harga_barang * $item['jumlah_barang']
                    ]);
                }
            }

        });

        return response()->json(['success' => true]);
    }

    public function show($id) {
        $order = Order::with('items.goods')->findOrFail($id);
        if (request()->ajax()) {
            return view('orders.show', compact('order'));
        }
        return redirect()->route('orders.index');
    }

    public function edit($id) {
        $order = Order::with('items.goods')->findOrFail($id);
        $goods = Goods::all();
        if (request()->ajax()) {
            return view('orders.edit', compact('order', 'goods'));
        }
        return redirect()->route('orders.index');
    }

    public function update(Request $request, $id) {
        $validated = $request->validate([
            'no_po' => 'required',
            'nama_po' => 'required',
            'tanggal' => 'required|date',
            'company' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'email' => 'required|email',
            'fax' => 'nullable',
            'pic' => 'required',
            'items' => 'nullable|array',
            'items.*.goods_id' => 'required_with:items.*|exists:goods,id',
            'items.*.jumlah_barang' => 'required_with:items.*|integer|min:1'
        ]);

        DB::transaction(function () use ($validated, $request, $id) {
            $order = Order::with('items')->findOrFail($id);

            // restore stok lama
            foreach ($order->items as $item) {
                $goods = Goods::find($item->goods_id);
                $goods->jumlah_barang += $item->jumlah_barang;
                $goods->save();
            }

            $order->items()->delete();

            $total_all = 0;
            if (!empty($validated['items'])) {
                foreach ($validated['items'] as $item) {
                    $goods = Goods::find($item['goods_id']);
                    if ($goods->jumlah_barang < $item['jumlah_barang']) {
                        throw ValidationException::withMessages([
                            'stok' => "Stok untuk {$goods->nama_barang} tidak mencukupi."
                        ]);
                    }
                    $total_all += $goods->harga_barang * $item['jumlah_barang'];
                }
            }

            $order->update([
                'no_po' => $validated['no_po'],
                'nama_po' => $validated['nama_po'],
                'tanggal' => $validated['tanggal'],
                'company' => $validated['company'],
                'alamat' => $validated['alamat'],
                'no_telp' => $validated['no_telp'],
                'email' => $validated['email'],
                'fax' => $validated['fax'],
                'pic' => $validated['pic'],
                'total_semua_barang' => $total_all,
                'keterangan' => $request->keterangan
            ]);

            if (!empty($validated['items'])) {
                foreach ($validated['items'] as $item) {
                    $goods = Goods::find($item['goods_id']);
                    $goods->jumlah_barang -= $item['jumlah_barang'];
                    $goods->save();

                    $order->items()->create([
                        'goods_id' => $item['goods_id'],
                        'jumlah_barang' => $item['jumlah_barang'],
                        'harga_barang' => $goods->harga_barang,
                        'total_harga_barang' => $goods->harga_barang * $item['jumlah_barang']
                    ]);
                }
            }
        });

        return redirect()->route('orders.index')
            ->with('success', 'Data order berhasil diperbarui.');
    }

    public function destroy($id) {
        $order = Order::with('items')->findOrFail($id);

        DB::transaction(function () use ($order) {
            // restore stok
            foreach ($order->items as $item) {
                $goods = Goods::find($item->goods_id);
                $goods->jumlah_barang += $item->jumlah_barang;
                $goods->save();
            }
            $order->delete();
        });

        return redirect()->route('orders.index')
            ->with('success', 'Data order berhasil dihapus.');
    }

    public function exportPdf() {
        $orders = Order::with('items.goods')->get();
        $pdf = Pdf::loadView('orders.pdf-orders', compact('orders'));
        return $pdf->download('orders_' . date('Y-m-d_H-i-s') . '.pdf');
    }

    public function exportExcel() {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->fromArray([
            ['No PO', 'Nama PO', 'Tanggal', 'Company', 'PIC', 'Total', 'Jumlah Item', 'Created', 'Updated']
        ]);

        $orders = Order::withCount('items')->get();
        $row = 2;
        foreach ($orders as $order) {
            $sheet->fromArray([
                $order->no_po,
                $order->nama_po,
                $order->tanggal,
                $order->company,
                $order->pic,
                $order->total_semua_barang,
                $order->items_count,
                $order->created_at,
                $order->updated_at
            ], null, "A$row");
            $row++;
        }

        $fileName = 'orders_' . now()->format('Ymd_His') . '.xlsx';
        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$fileName\"");
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit;
    }

    public function exportCsv() {
        $filename = 'orders.csv';
        $orders = Order::withCount('items')->get();

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
        ];

        $callback = function () use ($orders) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['No PO', 'Nama PO', 'Tanggal', 'Company', 'PIC', 'Total', 'Jumlah Item']);
            foreach ($orders as $order) {
                fputcsv($handle, [
                    $order->no_po,
                    $order->nama_po,
                    $order->tanggal,
                    $order->company,
                    $order->pic,
                    $order->total_semua_barang,
                    $order->items_count
                ]);
            }
            fclose($handle);
        };
        return response()->stream($callback, 200, $headers);
    }
}
