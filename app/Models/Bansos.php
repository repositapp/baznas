<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bansos extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['upz', 'amil'];
    protected $appends = ['durasi', 'jumlah_donatur', 'jumlah_dana', 'persen'];

    public function upz()
    {
        return $this->belongsTo(Upz::class, 'upz_id');
    }

    public function amil()
    {
        return $this->belongsTo(Amil::class, 'amil_id');
    }

    public function donaturs()
    {
        return $this->hasMany(Bansosdonatur::class);
    }

    public function bansosdonaturs()
    {
        return $this->hasMany(Bansosdonatur::class);
    }

    public function bansossaluran()
    {
        return $this->hasMany(Bansossaluran::class);
    }

    // Durasi program
    public function getDurasiAttribute()
    {
        return \Carbon\Carbon::parse($this->range_start)->diffInDays(\Carbon\Carbon::parse($this->range_end)) + 1;
    }

    // Jumlah donatur
    public function getJumlahDonaturAttribute()
    {
        return $this->donaturs->count();
    }

    // Jumlah dana terkumpul
    public function getJumlahDanaAttribute()
    {
        return $this->donaturs->sum('nominal_donasi');
    }

    // Persentase pencapaian
    public function getPersenAttribute()
    {
        if ($this->jumlah_donasi == 0) {
            return 0;
        }
        return ($this->jumlah_dana / $this->jumlah_donasi) * 100;
    }
}
