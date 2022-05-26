<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class KeteranganGudang extends Model
{
    use HasFactory;
    use SoftDeletes;

    public const ACTIVE = "aktif";

    protected $table = 'keterangan_gudang';
    protected $fillable = ['nama'];

    public function keterangan()
    {
        return $this->hasMany(GudangLumbung::class);
    }
}
