<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GoodsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SuratJalanController;
use App\Http\Controllers\PengirimanController;
use App\Http\Controllers\PendapatanController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/TesTemplate', function () {
    return view('surat-jalan');
});

// Company profile
Route::get('/index', function () {
    return view('index');
})->name('index');

Route::get('/price', function () {
    return view('price');
})->name('price');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/', function () {
    return view('index');
})->name('home');

// Admin page
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Data Barang
    Route::get('/goods', [GoodsController::class, 'index'])->name('goods.index');
    Route::get('/goods/create', [GoodsController::class, 'create'])->name('goods.create');
    Route::post('/goods', [GoodsController::class, 'store'])->name('goods.store');
    Route::get('/goods/{id}', [GoodsController::class, 'show'])->name('goods.show');
    Route::get('/goods/{id}/edit', [GoodsController::class, 'edit'])->name('goods.edit');
    Route::put('/goods/{id}', [GoodsController::class, 'update'])->name('goods.update');
    Route::delete('/goods/{id}', [GoodsController::class, 'destroy'])->name('goods.destroy');

    Route::get('/goods/export/excel', [GoodsController::class, 'exportExcel'])->name('goods.export.excel');
    Route::get('/goods/export/pdf', [GoodsController::class, 'exportPdf'])->name('goods.export.pdf');
    Route::get('/goods/export/csv', [GoodsController::class, 'exportCsv'])->name('goods.export.csv');

    // Data Order
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/orders/{id}/edit', [OrderController::class, 'edit'])->name('orders.edit');
    Route::put('/orders/{id}', [OrderController::class, 'update'])->name('orders.update');
    Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');

    Route::get('/orders/export/excel', [OrderController::class, 'exportExcel'])->name('orders.export.excel');
    Route::get('/orders/export/pdf', [OrderController::class, 'exportPdf'])->name('orders.export.pdf');
    Route::get('/orders/export/csv', [OrderController::class, 'exportCsv'])->name('orders.export.csv');

    // Surat Jalan
    Route::get('/surat-jalan', [SuratJalanController::class, 'create'])->name('surat-jalan');
    Route::post('/surat-jalan', [SuratJalanController::class, 'store'])->name('surat-jalan.store');
    Route::get('/surat-jalan/download/{id}', [SuratJalanController::class, 'download'])->name('surat-jalan.download');

    // Pengiriman
    Route::get('/pengiriman', [PengirimanController::class, 'index'])->name('pengiriman.index');
    // Route::post('/pengiriman', [PengirimanController::class, 'store'])->name('pengiriman.store');
    Route::get('/pengiriman/{id}', [PengirimanController::class, 'show'])->name('pengiriman.show');
    Route::get('/pengiriman/{id}/edit', [PengirimanController::class, 'edit'])->name('pengiriman.edit');
    Route::put('/pengiriman/{id}', [PengirimanController::class, 'update'])->name('pengiriman.update');
    Route::delete('/pengiriman/{id}', [PengirimanController::class, 'destroy'])->name('pengiriman.destroy');

    Route::get('/pengiriman/export/excel', [PengirimanController::class, 'exportExcel'])->name('pengiriman.export.excel');
    Route::get('/pengiriman/export/pdf', [PengirimanController::class, 'exportPdf'])->name('pengiriman.export.pdf');
    Route::get('/pengiriman/export/csv', [PengirimanController::class, 'exportCsv'])->name('pengiriman.export.csv');

    // Pendapatan
    Route::get('/pendapatan', [PendapatanController::class, 'index'])->name('pendapatan.index');
    Route::post('/pendapatan', [PendapatanController::class, 'store'])->name('pendapatan.store');
    Route::get('/pendapatan/{id}', [PendapatanController::class, 'show'])->name('pendapatan.show');
    // Route::get('/pendapatan/{id}/edit', [PendapatanController::class, 'edit'])->name('pendapatan.edit');
    // Route::put('/pendapatan/{id}', [PendapatanController::class, 'update'])->name('pendapatan.update');
    Route::delete('/pendapatan/{id}', [PendapatanController::class, 'destroy'])->name('pendapatan.destroy');

    Route::get('/pendapatan/export/excel', [PendapatanController::class, 'exportExcel'])->name('pendapatan.export.excel');
    Route::get('/pendapatan/export/pdf', [PendapatanController::class, 'exportPdf'])->name('pendapatan.export.pdf');
    Route::get('/pendapatan/export/csv', [PendapatanController::class, 'exportCsv'])->name('pendapatan.export.csv');

    // Pengeluaran
    Route::get('/pengeluaran', [PengeluaranController::class, 'index'])->name('pengeluaran.index');
    Route::post('/pengeluaran', [PengeluaranController::class, 'store'])->name('pengeluaran.store');
    Route::get('/pengeluaran/{id}', [PengeluaranController::class, 'show'])->name('pengeluaran.show');
    Route::get('/pengeluaran/{id}/edit', [PengeluaranController::class, 'edit'])->name('pengeluaran.edit');
    Route::put('/pengeluaran/{id}', [PengeluaranController::class, 'update'])->name('pengeluaran.update');
    Route::delete('/pengeluaran/{id}', [PengeluaranController::class, 'destroy'])->name('pengeluaran.destroy');

    Route::get('/pengeluaran/export/excel', [PengeluaranController::class, 'exportExcel'])->name('pengeluaran.export.excel');
    Route::get('/pengeluaran/export/pdf', [PengeluaranController::class, 'exportPdf'])->name('pengeluaran.export.pdf');
    Route::get('/pengeluaran/export/csv', [PengeluaranController::class, 'exportCsv'])->name('pengeluaran.export.csv');

});

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
