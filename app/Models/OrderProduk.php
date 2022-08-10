<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduk extends Model
{
    use HasFactory;
    protected $table = 'order_produk';
    protected $fillable = [
        'tanaman_id',
        'kondisi_id',
        'jumlah',
        'harga',
        'total'
    ];

    public function tanaman()
    {
        return $this->belongsTo(Tanaman::class, 'tanaman_id');
    }

    public function kondisi()
    {
        return $this->belongsTo(KondisiHasilPanen::class,'kondisi_id');
    }
}
