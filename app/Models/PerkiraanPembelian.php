<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerkiraanPembelian extends Model
{
    use HasFactory;

    public const ACTIVE = "aktif";

    protected $table = 'perkiraan_pembelian';
    protected $fillable = [
        'musim_panen',
        'tahun',
        // 'tanaman_id',
        // 'petani_id',
        // 'lahan_id',
        // 'luas_lahan',
        // 'jumlah',
        // 'satuan_id',
        // 'kondisi_id',
        // 'harga',
        // 'total'
    ];

    public function musim_panen()
    {
        return $this->hasMany(PembelianModal::class);
    }

    // public function tanaman()
    // {
    //     return $this->belongsTo(Tanaman::class,'tanaman_id');
    // }

    // public function kondisi()
    // {
    //     return $this->belongsTo(KondisiHasilPanen::class,'kondisi_id');
    // }

    // public function satuan()
    // {
    //     return $this->belongsTo(Satuan::class,'satuan_id');
    // }

    // public function lahan()
    // {
    //     return $this->belongsTo(DataJenisLahan::class,'nama');
    // }

    // public function petani()
    // {
    //     return $this->belongsTo(DataPetani::class,'nama');
    // }
}
