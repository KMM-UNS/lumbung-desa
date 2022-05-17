<?php

namespace App\Models;

use App\Models\Pembelian;
use App\Models\GudangLumbung;
use App\Models\PerkiraanPembelian;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KondisiHasilPanen extends Model
{
    use HasFactory;
    use SoftDeletes;

    public const ACTIVE = "aktif";

    protected $table = 'kondisi_hasil_panen';
    protected $fillable = ['nama'];
    public $timestamps = false;

    public function kondisitanamangudang()
    {
        return $this->hasMany(GudangLumbung::class);
    }

    public function kondisipembelian()
    {
        return $this->hasMany(Pembelian::class);
    }

    public function kondisiperkiraanpembelian()
    {
        return $this->hasMany(PerkiraanPembelian::class);
    }
}
