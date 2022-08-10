<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPembelianPupuk extends Model
{
    use HasFactory;

    public const ACTIVE = "aktif";

    protected $table = 'detail_pembelian_pupuk';
    protected $fillable = [
        'pembelian_id',
        'pupuk_id',
        'jumlah',
        'harga',
        'total'
    ];
    public $timestamps = true;
    protected $dates = ['tanggal_pembelian'];


    public function detailpupuk()
    {
        return $this->belongsTo(DataPupuk::class, 'pupuk_id');
    }

    public function pembelian()
    {
        return $this->belongsTo(PembelianPupuk::class);
    }
}
