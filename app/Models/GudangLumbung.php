<?php

namespace App\Models;

use App\Models\Tanaman;
use App\Models\JenisTanaman;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GudangLumbung extends Model
{
    use HasFactory;
    use SoftDeletes;

    public const ACTIVE = "aktif";

    protected $table = 'gudang_lumbung';
    protected $fillable = ['nama_tanaman_id','jenis_tanaman_id','stok','satuan','kondisi_id'];
    public $timestamps = false;

    public function jenistanaman()
    {
        return $this->belongsTo(JenisTanaman::class,'jenis_tanaman_id');
    }

    public function tanaman()
    {
        return $this->belongsTo(Tanaman::class,'nama_tanaman_id');
    }
}
