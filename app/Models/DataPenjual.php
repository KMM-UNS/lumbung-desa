<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPenjual extends Model
{
    use HasFactory;

    public const ACTIVE = "aktif";

    protected $table = 'data_penjuals';
    protected $fillable = [
        'nama',
        'instansi',
        'email',
        'no_hp',
        'alamat'
    ];
    public $timestamps = false;

    // public function pembeli()
    // {
    //     return $this->hasMany(PenjualanProduk::class); //'petani_id' itu nama kolom yang mengambil data petani
    // }
}
