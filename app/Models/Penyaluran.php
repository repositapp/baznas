<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyaluran extends Model
{
    use HasFactory;
    // protected $guarded = ['id'];
    protected $fillable = [
        'upz_id',
        'amil_id',
        'mustahik_id',
        'zakat_id',
        'kode_penyaluran',
        'tgl_penyaluran',
        'total'
    ];
    protected $with = ['upz', 'amil', 'mustahik', 'zakat'];

    public function upz()
    {
        return $this->belongsTo(Upz::class, 'upz_id');
    }

    public function amil()
    {
        return $this->belongsTo(Amil::class, 'amil_id');
    }

    public function mustahik()
    {
        return $this->belongsTo(Mustahik::class, 'mustahik_id');
    }

    public function zakat()
    {
        return $this->belongsTo(Zakat::class, 'zakat_id');
    }

    public function gambar()
    {
        return $this->hasOne(Penyalurangbr::class, 'kode_penyaluran', 'kode_penyaluran');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($penyaluran) {
            $tanggal = now()->format('d/m/y');
            $angkaRomawi = array(
                '01' => 'I',
                '02' => 'II',
                '03' => 'III',
                '04' => 'IV',
                '05' => 'V',
                '06' => 'VI',
                '07' => 'VII',
                '08' => 'VIII',
                '09' => 'IX',
                '10' => 'X',
                '11' => 'XI',
                '12' => 'XII'
            );

            $bulan = date('m');
            $kodeBulan = $angkaRomawi[$bulan];
            // Cek jumlah penyaluran pada hari yang sama
            $countToday = Penyaluran::whereDate('created_at', now()->toDateString())->count() + 1;

            $kodeUrut = str_pad($countToday, 6, '0', STR_PAD_LEFT); // jadikan 0000001, 0000002, dst
            $penyaluran->kode_penyaluran = $tanggal . '/' . 'PYZ/' . $kodeBulan . '/' .  $kodeUrut;
        });
    }
}
