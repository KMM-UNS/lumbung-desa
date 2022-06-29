<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembelianPupuk extends Model
{
    use HasFactory;

    public const ACTIVE = "aktif";

    protected $table = 'pembelian_pupuk';
    protected $fillable = [
        'no_pembelian',
        'tanggal_pembelian',
        'pupuk_id',
        'jumlah',
        'harga',
        'total'
    ];

    public function pupuk()
    {
        return $this->belongsTo(DataPupuk::class,'pupuk_id');
    }
}
