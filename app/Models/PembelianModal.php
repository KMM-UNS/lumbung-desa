<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembelianModal extends Model
{
    use HasFactory;

    protected $table = 'pembelian_modal';
    protected $fillable = [
        'musim_panen_id',
        'tanaman_id',
        'petani_id',
        'lahan_id',
        'luas_lahan',
        'jumlah',
        'kondisi_id',
        'harga',
        'total'
    ];

    public function musim_panen()
    {
        return $this->belongsTo(PerkiraanPembelian::class,'musim_panen_id');
    }

    public function tanaman()
    {
        return $this->belongsTo(Tanaman::class,'tanaman_id');
    }

    public function kondisi()
    {
        return $this->belongsTo(KondisiHasilPanen::class,'kondisi_id');
    }

    public function lahan()
    {
        return $this->belongsTo(DataJenisLahan::class,'lahan_id');
    }

    public function petani()
    {
        return $this->belongsTo(DataPetani::class,'petani_id');
    }
}
