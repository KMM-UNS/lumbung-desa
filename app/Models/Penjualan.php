<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Penjualan extends Model
{
    use HasFactory;
    use SoftDeletes;

    public const ACTIVE = "aktif";

    protected $table = 'penjualans';
    protected $fillable =
    [
        'id','no_penjualan','nama','kondisi','jumlah','harga'
    ];
    public $timestamps = false;

    public function detail($id)
    {
    return DB::table('penjualans')->where('id','$id')->first();
    }
}
