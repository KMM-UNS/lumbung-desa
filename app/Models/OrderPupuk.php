<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPupuk extends Model
{
    use HasFactory;
    protected $table = 'order_pupuk';
    protected $fillable = [
        'no_pembelian',
        'pupuk_order_id',
        'jumlah',
        'harga',
        'total'
    ];

    public function order_pupuk()
    {
        return $this->belongsTo(DataPupuk::class,'pupuk_order_id');
    }
}
