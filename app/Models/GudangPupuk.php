<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GudangPupuk extends Model
{
    use HasFactory;

    public const ACTIVE = "aktif";

    protected $table = 'gudang_pupuk';
    protected $fillable = ['nama_pupuk','stok','keterangan'];
    public $timestamps = false;

    public function pupuk()
    {
        return $this->belongsTo(DataPupuk::class,'nama_pupuk');
    }
}
