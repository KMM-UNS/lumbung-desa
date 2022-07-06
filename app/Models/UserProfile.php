<?php

namespace App\Models;

use App\Traits\FillableInputTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory, FillableInputTrait;

    protected $table = "user_profile";
    protected $fillable = [
        'nik_ektp',
        'gender',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'no_telp',
    ];

    protected $dates = ['tanggal_lahir'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
