<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bansosdonatur extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['bansos', 'akunbank'];

    public function bansos()
    {
        return $this->belongsTo(Bansos::class);
    }

    public function akunbank()
    {
        return $this->belongsTo(AkunBank::class);
    }
}
