<?php

namespace App\Models;

use App\Models\Tanaman;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataPupuk extends Model
{
    use HasFactory;
    use SoftDeletes;

    public const ACTIVE = "aktif";

    protected $table = 'data_pupuks';
    protected $fillable =
    [
        'id','nama','jenis_pupuk','berat', 'harga'
    ];
    public $timestamps = false;

    public function pupuktanaman()
    {
        return $this->hasMany(Tanaman::class);
    }
}
