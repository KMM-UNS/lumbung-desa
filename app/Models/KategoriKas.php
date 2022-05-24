<?php

namespace App\Models;

use App\Models\Kas;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KategoriKas extends Model
{
    use HasFactory;
    use SoftDeletes;

    public const ACTIVE = "aktif";

    protected $table = 'kategori_kas';
    protected $fillable = ['nama'];

    public function kas()
    {
        return $this->hasMany(Kas::class);
    }
}
