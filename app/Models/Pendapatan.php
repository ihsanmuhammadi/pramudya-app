<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Pendapatan extends Model
{
    /** @use HasFactory<\Database\Factories\PendapatanFactory> */
    protected $table = 'pendapatan';

    use HasFactory;

    use HasUuids;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = ['order_id'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
