<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Goods extends Model
{
    use HasUuids;

    use HasFactory;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'nama_barang',
        'jumlah_barang',
        'satuan_barang',
        'harga_barang',
        'kode_barang',
        'spesifikasi'
    ];
}
