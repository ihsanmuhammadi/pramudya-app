<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GoodsController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/generate', function () {
    return view('generate');
})->middleware(['auth', 'verified'])->name('generate');

Route::get('/index', function () {
    return view('index');
})->middleware(['auth', 'verified'])->name('index');

Route::get('/price', function () {
    return view('price');
})->middleware(['auth', 'verified'])->name('price');

Route::get('/about', function () {
    return view('about');
})->middleware(['auth', 'verified'])->name('about');

Route::get('/goods', [GoodsController::class, 'index'])->name('goods.index');
Route::get('/goods/create', [GoodsController::class, 'create'])->name('goods.create');
Route::post('/goods', [GoodsController::class, 'store'])->name('goods.store');
Route::get('/goods/{id}', [GoodsController::class, 'show'])->name('goods.show');
Route::get('/goods/{id}/edit', [GoodsController::class, 'edit'])->name('goods.edit');
Route::put('/goods/{id}', [GoodsController::class, 'update'])->name('goods.update');
Route::delete('/goods/{id}', [GoodsController::class, 'destroy'])->name('goods.destroy');

// Add these routes to your web.php file
Route::get('/goods/export/excel', [GoodsController::class, 'exportExcel'])->name('goods.export.excel');
Route::get('/goods/export/pdf', [GoodsController::class, 'exportPdf'])->name('goods.export.pdf');
Route::get('/goods/export/csv', [GoodsController::class, 'exportCsv'])->name('goods.export.csv');

Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
Route::get('/orders/{id}/edit', [OrderController::class, 'edit'])->name('orders.edit');
Route::put('/orders/{id}', [OrderController::class, 'update'])->name('orders.update');
Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');

Route::get('/orders/export/excel', [OrderController::class, 'exportExcel'])->name('orders.export.excel');
Route::get('/orders/export/pdf', [OrderController::class, 'exportPdf'])->name('orders.export.pdf');
Route::get('/orders/export/csv', [OrderController::class, 'exportCsv'])->name('orders.export.csv');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
