<?php

namespace App\Models;

use App\Models\Tanaman;
use App\Models\DataLahan;
use App\Models\DataPetani;
use App\Models\KondisiHasilPanen;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Alfa6661\AutoNumber\AutoNumberTrait;

class Pembelian extends Model
{
    use HasFactory;
    use AutoNumberTrait;

    public const ACTIVE = "aktif";

    protected $table = 'pembelian';
    protected $fillable = [
        'no_pembelian',
        'tanggal_pembelian',
        'musim_id',
        'petani_id',
        'subtotal',
        // 'tanaman_id',
        // 'kondisi_id',
        // 'jumlah',
        // 'harga',
        // 'total'
    ];
    protected $dates = ['tanggal_pembelian'];
    public $timestamps = false;

    public function musim()
    {
        return $this->belongsTo(PerkiraanPembelian::class,'musim_id');
    }

    public function tanaman()
    {
        return $this->belongsTo(Tanaman::class,'tanaman_id');
    }

    public function kondisi()
    {
        return $this->belongsTo(KondisiHasilPanen::class,'kondisi_id');
    }

    public function petani()
    {
        return $this->belongsTo(DataPetani::class,'petani_id');
    }

    public function lahan()
    {
        return $this->belongsTo(DataLahan::class,'lahan_id');
    }

    public function detailpembelian()
    {
        return $this->hasMany(DetailPembelianProduk::class);
    }

    public function getAutoNumberOptions()
    {
        return [
            'no_pembelian' => [
                'format' => 'LDB.?', // Format kode yang akan digunakan.
                'length' => 5 // Jumlah digit yang akan digunakan sebagai nomor urut
            ]
        ];
    }
}
