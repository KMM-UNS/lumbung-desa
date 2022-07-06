<?php

namespace App\Models;

use App\Models\Satuan;
use App\Models\Tanaman;
use App\Models\Penjualan;
use App\Models\PenjualanProduk;
use App\Models\PenjualanPupuk;
use App\Models\JenisTanaman;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GudangLumbung extends Model
{
    use HasFactory;
    // use SoftDeletes;

    public const ACTIVE = "aktif";

    protected $table = 'gudang_lumbung';
    protected $fillable = ['nama_tanaman_id','stok','kondisi_id','keterangan_id'];
    public $timestamps = false;

    public function tanaman()
    {
        return $this->belongsTo(Tanaman::class,'nama_tanaman_id');
    }

    public function satuan()
    {
        return $this->belongsTo(Satuan::class,'satuan_id');
    }

    public function kondisi()
    {
        return $this->belongsTo(KondisiHasilPanen::class,'kondisi_id');
    }

    public function keterangangudang()
    {
        return $this->belongsTo(KeteranganGudang::class,'keterangan_id');
    }

    public function penjualans()
    {
        return $this->hasMany(Penjualan::class);
    }

    public function penjualanproduk()
    {
        return $this->hasMany(PenjualanProduk::class);
    }

    public function penjualanpupuk()
    {
        return $this->hasMany(PenjualanPupuk::class);
    }

}
