<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    use HasUuids;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = ['no_po', 'nama_po', 'tanggal','company','alamat','no_telp','email','fax','pic','total_semua_barang','keterangan'];

    public function items() {
        return $this->hasMany(OrderItem::class);
    }

    public function pendapatan()
    {
        return $this->hasOne(Pendapatan::class);
    }

    // Order.php
    public function pengiriman()
    {
        return $this->hasOne(Pengiriman::class);
    }

}
