<?php

namespace App\Models;

use App\Models\Tanaman;
use App\Models\DaftarProduk;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class KeteranganGudang extends Model
{
    use HasFactory;
    // use SoftDeletes;

    public const ACTIVE = "aktif";

    protected $table = 'keterangan_gudang';
    protected $fillable = ['nama'];

    public function keterangan()
    {
        return $this->hasMany(Tanaman::class);
    }
    public function keterangandaftarproduk()
    {
        return $this->hasMany(DaftarProduk::class);
    }
}
