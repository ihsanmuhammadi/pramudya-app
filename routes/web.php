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

// Admin routes
Route::resource('goods', GoodsController::class);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
