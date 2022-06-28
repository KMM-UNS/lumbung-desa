<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Pendidikan extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'pendidikan';
    protected $fillable = ['nama'];
    public $timestamps = false;

    public function setNamaAttribute($value)
    {
        return $this->attributes['nama'] = Str::ucfirst($value);
    }

    public function pendaftar()
    {
        return $this->hasMany(Pendaftar::class);
    }
}
