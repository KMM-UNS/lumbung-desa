<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DataLahan extends Model
{
    use HasFactory;
    use SoftDeletes;

    public const ACTIVE = "aktif";

    protected $table = 'data_lahans';
    protected $fillable = 
    [
        'id','','petani_id','jenis_lahan','luas_tanah'
    ];
    public $timestamps = false;
}
