<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyalurangbr extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function penyaluran()
    {
        return $this->belongsTo(Penyaluran::class, 'kode_penyaluran', 'kode_penyaluran');
    }
}
