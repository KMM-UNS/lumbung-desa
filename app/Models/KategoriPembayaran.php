<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriPembayaran extends Model
{
    use HasFactory;

    protected $table = 'kategori_pembayaran';
    protected $fillable = ['nama'];
}
