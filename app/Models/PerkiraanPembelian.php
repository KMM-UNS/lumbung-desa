<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerkiraanPembelian extends Model
{
    use HasFactory;

    public const ACTIVE = "aktif";

    protected $table = 'perkiraan_pembelian';
    protected $fillable = [
        'musim_panen',
        'tahun',
        // 'modal'
    ];

    public function musim_panen()
    {
        return $this->hasMany(PembelianModal::class);
    }

    public function modal()
    {
        return $this->hasMany(PembelianModal::class);
    }
}
