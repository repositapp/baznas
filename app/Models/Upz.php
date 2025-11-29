<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upz extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['kategoriupz'];

    public function kategoriupz()
    {
        return $this->belongsTo(Kategoriupz::class, 'kategoriupz_id');
    }

    public function amil()
    {
        return $this->hasMany(Amil::class);
    }

    public function muzaki()
    {
        return $this->hasMany(Muzaki::class);
    }

    public function mustahik()
    {
        return $this->hasMany(Mustahik::class);
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
