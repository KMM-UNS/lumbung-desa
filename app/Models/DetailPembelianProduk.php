<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPembelianProduk extends Model
{
    use HasFactory;

    public const ACTIVE = "aktif";

    protected $table = 'detail_pembelian_produk';
    protected $fillable = [
        'pembelian_id',
        'tanaman_id',
        'kondisi_id',
        'jumlah',
        'harga',
        'total'
    ];

    public $timestamps = true;
    protected $dates = ['tanggal_pembelian'];


    public function detailproduk()
    {
        return $this->belongsTo(Tanaman::class, 'tanaman_id');
    }

    public function detailkondisi()
    {
        return $this->belongsTo(KondisiHasilPanen::class, 'kondisi_id');
    }

    public function pembelian()
    {
        return $this->belongsTo(Pembelian::class);
    }
}
