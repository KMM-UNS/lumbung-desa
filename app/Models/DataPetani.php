<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\DataLahan;
// use App\Traits\FillableInputTrait;

class DataPetani extends Model
{
    use HasFactory;
    use SoftDeletes;
    // use FillableInputTrait;

    public const ACTIVE = "aktif";

    protected $table = 'data_petanis';
    protected $fillable =
    [
    'no_kk','nik','nama','tempat_lahir','tanggal_lahir','jenis_kelamin','alamat'
    ];
    public $timestamps = false;

    public function lahan()
    {
        return $this->hasMany(DataLahan::class);
    }

    // public function pembelian()
    // {
    //     return $this->hasMany(Pembelian::class);
    // }

    // public function perkiraanpembelian()
    // {
    //     return $this->hasMany(Pembelian::class);
    // }

    public function petani()
    {
        return $this->hasMany(Pembelian::class,'petani_id');
    }

    public function petaniperkiraan()
    {
        return $this->hasMany(PerkiraanPembelian::class);
    }

    // public function creatable()
    // {
    //     return $this->morphTo();
    // }
}
