<?php

namespace App\Models;

use App\Models\Musim;
use App\Models\DataPupuk;
use Illuminate\Support\Str;
use App\Models\JenisTanaman;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tanaman extends Model
{
    use HasFactory;
    use SoftDeletes;

    public const ACTIVE = "aktif";

    protected $table = 'tanamen';
    protected $fillable = ['jenis_tanaman_id','nama','musim_tanam_id','waktu_tanam','jenis_pupuk_id','keterangan'];
    public $timestamps = false;

    // public function setNamaAttribute($value)
    // {
    //     return $this->attributes['nama'] = Str::ucfirst($value);
    // }

    // public function scopeActive($query)
    // {
    //     return $query->where('status', static::ACTIVE);
    // }

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
}
