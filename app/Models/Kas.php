<?php

namespace App\Models;

use App\Models\KategoriKas;
use Database\Seeders\KategoriKasSeeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kas extends Model
{
    use HasFactory;
    use SoftDeletes;

    public const ACTIVE = "aktif";

    protected $table = 'kas';
    protected $fillable = [
        'tanggal',
        'kategori_id',
        'keterangan',
        'pembayaran',
        'jumlah',
        'saldo'
    ];

    public function kategorikas()
    {
        return $this->belongsTo(KategoriKas::class,'kategori_id');
    }
}
