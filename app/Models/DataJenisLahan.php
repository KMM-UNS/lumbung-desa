<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DataJenisLahan extends Model
{
    use HasFactory;
    use SoftDeletes;

    public const ACTIVE = "aktif";

    protected $table = 'data_jenis_lahans';
    protected $fillable =
    [
        'id','','nama',
    ];
    public $timestamps = false;

    public function perkiraanpembelian()
    {
        return $this->hasMany(PerkiraanPembelian::class);
    }
}
