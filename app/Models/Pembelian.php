<?php

namespace App\Models;

use App\Models\Musim;
use App\Models\Satuan;
use App\Models\Tanaman;
use App\Models\DataLahan;
use App\Models\DataPetani;
use App\Models\KondisiHasilPanen;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembelian extends Model
{
    use HasFactory;
    use SoftDeletes;

    public const ACTIVE = "aktif";

    protected $table = 'pembelian';
    protected $fillable = [
        'musim_id',
        'tanaman_id',
        'petani_id',
        'no_pembelian',
        'tanggal_pembelian',
        'jumlah',
        'satuan_id',
        'kondisi_id',
        'harga',
        'total'
    ];
    public $timestamps = false;

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

    public function petani()
    {
        return $this->belongsTo(DataPetani::class,'petani_id');
    }

    public function lahan()
    {
        return $this->belongsTo(DataLahan::class,'lahan_id');
    }
}
