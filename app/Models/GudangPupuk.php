<?php

namespace App\Models;

use App\Models\DataPupuk;
use App\Models\PenjualanPupuk;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GudangPupuk extends Model
{
    use HasFactory;

    public const ACTIVE = "aktif";

    protected $table = 'gudang_pupuk';
    protected $fillable = ['nama_pupuk','stok','keterangan'];
    public $timestamps = false;

    public function pupuk()
    {
        return $this->belongsTo(DataPupuk::class,'nama_pupuk');
    }

    public function ppk()
    {
        return $this->belongsTo(DataPupuk::class,'nama_pupuk');
    }

    public function penjualanpupuk()
    {
        return $this->hasMany(PenjualanPupuk::class);
    }
}
