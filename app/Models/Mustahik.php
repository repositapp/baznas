<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mustahik extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['golongan', 'upz'];

    public function golongan()
    {
        return $this->belongsTo(Golongan::class, 'golongan_id');
    }

    public function upz()
    {
        return $this->belongsTo(Upz::class, 'upz_id');
    }
}
