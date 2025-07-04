<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GoodsController;
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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
