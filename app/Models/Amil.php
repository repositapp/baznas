<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amil extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['user', 'upz'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function upz()
    {
        return $this->belongsTo(Upz::class, 'upz_id');
    }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class);
    }

    public function bansos()
    {
        return $this->hasMany(Bansos::class);
    }
}
