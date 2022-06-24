<?php

namespace App\Models;

use App\Models\Musim;
use App\Models\DataPupuk;
use App\Models\Pembelian;
use Illuminate\Support\Str;
use App\Models\JenisTanaman;
use App\Models\PembelianModal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tanaman extends Model
{
    use HasFactory;

    public const ACTIVE = "aktif";

    protected $table = 'tanamen';
    protected $fillable = ['jenis_tanaman_id','nama','musim_tanam_id','waktu_tanam','jenis_pupuk_id','keterangan'];
    public $timestamps = false;

    public function jenistanaman()
    {
        return $this->belongsTo(JenisTanaman::class,'jenis_tanaman_id');
    }

    public function pupuk()
    {
        return $this->belongsTo(DataPupuk::class,'jenis_pupuk_id');
    }

    public function musimtanam()
    {
        return $this->belongsTo(Musim::class,'musim_tanam_id');
    }

    public function pembeliantanaman()
    {
        return $this->hasMany(Pembelian::class);
    }

    public function perkiraanpembeliantanaman()
    {
        return $this->hasMany(PembelianModal::class);
    }
}
