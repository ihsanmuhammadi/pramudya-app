<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Goods extends Model
{
    use HasUuids;

    protected $fillable = [
        'nama_barang',
        'jumlah_barang',
        'satuan_barang',
        'harga_barang',
        'kode_barang',
        'spesifikasi'
    ];
}
