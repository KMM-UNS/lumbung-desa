<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Alfa6661\AutoNumber\AutoNumberTrait;
use App\DataTables\Admin\Penjualan\PenjualanPupukDataTable;
use App\Models\GudangPupuk;

class PenjualanPupuk extends Model
{
    use HasFactory;
    use SoftDeletes;
    use AutoNumberTrait;
    public const ACTIVE = "aktif";

    protected $table = 'penjualan_pupuks';
    protected $fillable =
    [
     'id','no_penjualan','tgl_penjualan','nama','email','no_hp','alamat','produk_id','harga','jumlah','total'
    ];
    public $timestamps = false;

    // public function kondisihasilpanen()
    // {
    //     return $this->belongsTo(KondisiHasilPanen::class,'kondisi');
    // }


    public function getAutoNumberOptions()
    {
        return [
            'no_penjualan' => [
                'format' => 'LD.?', // Format kode yang akan digunakan.
                'length' => 5 // Jumlah digit yang akan digunakan sebagai nomor urut
            ]

        ];
    }
    // ['tgl_penjualan']
    // ['nama']
    // ['email']
    // ['no_hp']
    // ['alamat']
    // ['produk']
    // ['harga']
    // ['jumlah']
    //  ['total]']
    public function produk()
    {
        return $this->belongsTo(GudangPupuk::class,'produk_id'); //'produk_id' itu nama kolom yang mengambil data pupuk
    }

    // public function kondisi()
    // {
    //     return $this->belongsTo(GudangLumbung::class,'kondisi');
    // }

    // public function keterangan()
    // {
    //     return $this->belongsTo(GudangLumbung::class,'keterangan');
    // }
}
