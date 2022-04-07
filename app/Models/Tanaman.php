<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use App\Models\JenisTanaman;

class Tanaman extends Model
{
    use HasFactory;
    use SoftDeletes;

    public const ACTIVE = "aktif";

    protected $table = 'tanamen';
    protected $fillable = ['jenis_tanaman_id','nama','masa_tanam','keterangan'];
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
        return $this->belongsTo(DataPupuk::class,'pupuk');
    }
}
