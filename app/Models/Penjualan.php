<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Penjualan extends Model
{
    use HasFactory;
    use SoftDeletes;

    public const ACTIVE = "aktif";

    protected $table = 'penjualans';
    protected $fillable =
    [
        'id','no_penjualan','tgl_penjualan','nama','email','no_hp','alamat','jumlah', 'harga','produk','total'
    ];
    public $timestamps = false;

    public function kondisihasilpanen()
    {
        return $this->belongsTo(KondisiHasilPanen::class,'kondisi');
    }
}
