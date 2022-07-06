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

    public function namapetani()
    {
        return $this->belongsTo(DataPetani::class,'petani_id'); //'petani_id' itu nama kolom yang mengambil data petani
    }

    public function jenislahan()
    {
        return $this->belongsTo(DataJenisLahan::class,'jenis_lahan'); //'jenis_lahan' itu nama kolom yang mengambil data jenis lahan
    }

    public function petani()
    {
        return $this->hasMany(DataPetani::class);
    }
}
