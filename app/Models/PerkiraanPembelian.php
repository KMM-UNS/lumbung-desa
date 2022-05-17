<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PerkiraanPembelian extends Model
{
    use HasFactory;
    use SoftDeletes;

    public const ACTIVE = "aktif";

    protected $table = 'perkiraan_pembelian';
    protected $fillable = [
        'musim_id',
        'tanaman_id',
        'petani_id',
        'lahan_id',
        'luas_lahan',
        'jumlah',
        'satuan_id',
        'kondisi_id',
        'harga',
        'total'
    ];

    public function musim()
    {
        return $this->belongsTo(Musim::class,'musim_id');
    }

    public function tanaman()
    {
        return $this->belongsTo(Tanaman::class,'tanaman_id');
    }

    public function kondisi()
    {
        return $this->belongsTo(KondisiHasilPanen::class,'kondisi_id');
    }

    public function satuan()
    {
        return $this->belongsTo(Satuan::class,'satuan_id');
    }
}
