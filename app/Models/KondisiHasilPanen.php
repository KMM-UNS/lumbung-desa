<?php

namespace App\Models;

use App\Models\Pembelian;
use App\Models\GudangLumbung;
use App\Models\PembelianModal;
use App\Models\DaftarProduk;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KondisiHasilPanen extends Model
{
    use HasFactory;

    public const ACTIVE = "aktif";

    protected $table = 'kondisi_hasil_panen';
    protected $fillable = ['nama'];
    public $timestamps = false;

    public function kondisitanamangudang()
    {
        return $this->hasMany(GudangLumbung::class);
    }

    public function kondisipembelian()
    {
        return $this->hasMany(Pembelian::class);
    }

    public function kondisiperkiraanpembelian()
    {
        return $this->hasMany(PembelianModal::class);
    }

    public function kondisidaftarproduk()
    {
        return $this->hasMany(DaftarProduk::class);
    }
}
