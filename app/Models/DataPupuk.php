<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPupuk extends Model
{
    use HasFactory;

    public const ACTIVE = "aktif";

    protected $table = 'data_pupuks';
    protected $fillable =
    [
        'id','nama','jenis_pupuk','berat', 'harga'
    ];
    public $timestamps = false;

    public function pupuktanaman()
    {
        return $this->hasMany(Tanaman::class);
    }

    public function gudang()
    {
        return $this->hasMany(GudangPupuk::class);
    }

    public function pembelian()
    {
        return $this->hasMany(PembelianPupuk::class);
    }
}
