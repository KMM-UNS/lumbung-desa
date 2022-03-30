<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DataPetani extends Model
{
    use HasFactory;
    use SoftDeletes;

    public const ACTIVE = "aktif";

    protected $table = 'data_petanis';
    protected $fillable = 
    [
        'id','no_kk','nik','nama','tempat_lahir','tanggal_lahir','jenis_kelamin','alamat','foto'
    ];
    public $timestamps = false;
}
