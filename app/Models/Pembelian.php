<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pembelian extends Model
{
    use HasFactory;
    use SoftDeletes;

    public const ACTIVE = "aktif";

    protected $table = 'pembelian';
    protected $fillable = [
        'musim',
        'tanaman',
        'lahan',
        'no_pembelian',
        'tanggal_pembelian',
        'jumlah',
        'kondisi',
        'harga',
    ];
    public $timestamps = false;
}
