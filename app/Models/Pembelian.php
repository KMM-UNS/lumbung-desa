<?php

namespace App\Models;

use App\Models\Musim;
use App\Models\Tanaman;
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
}
