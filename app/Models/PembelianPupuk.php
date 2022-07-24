<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Alfa6661\AutoNumber\AutoNumberTrait;

class PembelianPupuk extends Model
{
    use HasFactory;
    use AutoNumberTrait;

    public const ACTIVE = "aktif";

    protected $table = 'pembelian_pupuk';
    protected $fillable = [
        'no_pembelian',
        'tanggal_pembelian',
        'penjual_id',
        'pupuk_id',
        'jumlah',
        'harga',
        'total'
    ];

    public function pupuk()
    {
        return $this->belongsTo(DataPupuk::class,'pupuk_id');
    }

    public function pembelianpupuk()
    {
        return $this->hasMany(DataPupuk::class,'pupuk_id');
    }

    public function penjual()
    {
        return $this->belongsTo(DataPenjual::class, 'penjual_id');
    }

    public function getAutoNumberOptions()
    {
        return [
            'no_pembelian' => [
                'format' => 'LDC.?', // Format kode yang akan digunakan.
                'length' => 5 // Jumlah digit yang akan digunakan sebagai nomor urut
            ]
        ];
    }
}
