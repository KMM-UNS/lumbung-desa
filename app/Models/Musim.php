<?php

namespace App\Models;

use App\Models\Tanaman;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Musim extends Model
{
    use HasFactory;
    use SoftDeletes;

    public const ACTIVE = "aktif";

    protected $table = 'musim';
    protected $fillable = ['nama'];
    public $timestamps = false;

    public function tanammusim()
    {
        return $this->hasMany(Tanaman::class);
    }
}
