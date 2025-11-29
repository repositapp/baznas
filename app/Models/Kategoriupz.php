<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategoriupz extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function upzs()
    {
        return $this->hasMany(Upz::class);
    }
}
