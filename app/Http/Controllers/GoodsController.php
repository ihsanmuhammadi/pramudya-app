<?php

namespace App\Http\Controllers;

use App\Models\Goods;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\DataTables\GoodsDataTable;

class GoodsController extends Controller
{
     // Show create form
    public function create(): View {
        return view('goods.create');
    }

    // List goods
    public function index(GoodsDataTable $dataTable) {
        return $dataTable->render('goods');
    }

    // Store new department
    public function store(Request $request): RedirectResponse {
        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'jumlah_barang' => 'required|integer|min:0',
            'satuan_barang' => 'required|integer|min:1',
            'harga_barang' => 'required|numeric|min:0',
            'kode_barang' => 'required|string',
            'spesifikasi' => 'nullable|string'
        ]);

        Goods::create($validated);

        return redirect()->route('goods.index')
            ->with('success', 'Data barang berhasil ditambahkan.');
    }

    // Show single goods by route model binding
    public function show(Goods $goods): View {
        return view('goods.show', compact('goods'));
    }

    // Edit form
    public function edit(Goods $goods): View {
        return view('goods.edit', compact('goods'));
    }

    // Update goods
    public function update(Request $request, Goods $goods): RedirectResponse {
        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'jumlah_barang' => 'required|integer|min:0',
            'satuan_barang' => 'required|integer|min:1',
            'harga_barang' => 'required|numeric|min:0',
            'kode_barang' => 'required|string|unique:barang,kode_barang',
            'spesifikasi' => 'nullable|string'
        ]);

        $goods->update($validated);

        return redirect()->route('goods.index')
            ->with('success', 'Data barang berhasil diperbarui.');
    }

    // Delete goods
    public function destroy(Goods $goods): RedirectResponse {
        $goods->delete();

        return redirect()->route('goods.index')
            ->with('success', 'Data barang berhasil dihapus.');
    }
}
