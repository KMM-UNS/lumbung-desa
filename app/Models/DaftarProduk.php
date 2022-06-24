<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DaftarProduk extends Model
{
    use HasFactory;
    use SoftDeletes;

    public const ACTIVE = "aktif";

    protected $table = 'daftar_produks';
    protected $fillable =
    [
        'id','nama','kondisi','keterangan','harga_beli','harga_jual'
    ];
    public $timestamps = false;
    public function kondisi()
    {
        return $this->belongsTo(KondisiHasilPanen::class,'kondisi');
    }

    public function keterangan()
    {
        return $this->belongsTo(KeteranganGudang::class,'keterangan');
    }

}
