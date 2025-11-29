<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Muzaki extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['upz'];

    public function upz()
    {
        return $this->belongsTo(Upz::class, 'upz_id');
    }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class);
    }
}
