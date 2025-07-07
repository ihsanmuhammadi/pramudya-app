<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Pengiriman extends Model
{
    /** @use HasFactory<\Database\Factories\PengirimanFactory> */
    use HasFactory;
    use HasUuids;

    protected $table = 'pengiriman';
    protected $fillable = [
        'no_surat', 'order_id', 'tanggal', 'penerima', 'keterangan_penerima', 'kendaraan', 'status'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
