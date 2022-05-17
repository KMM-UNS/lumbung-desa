<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
}
