<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// use App\Traits\FillableInputTrait;

class DataPembeli extends Model
{
    use HasFactory;
    use SoftDeletes;
    // use FillableInputTrait;

    public const ACTIVE = "aktif";

    protected $table = 'data_pembelis';
    protected $fillable =
    [
    'nama','instansi','email','no_hp','alamat'
    ];
    public $timestamps = false;

    public function pembeli()
    {
        return $this->hasMany(Penjualan::class,'nama'); //'petani_id' itu nama kolom yang mengambil data petani
    }
}
