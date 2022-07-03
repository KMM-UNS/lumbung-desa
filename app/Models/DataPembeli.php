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
    'nama','jenis_kelamin','email','no_hp','alamat'
    ];
    public $timestamps = false;


}
