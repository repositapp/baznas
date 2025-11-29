<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['upz', 'amil', 'muzaki', 'zakat', 'akunbank'];

    public function upz()
    {
        return $this->belongsTo(Upz::class, 'upz_id');
    }

    public function amil()
    {
        return $this->belongsTo(Amil::class, 'amil_id');
    }

    public function muzaki()
    {
        return $this->belongsTo(Muzaki::class, 'muzaki_id');
    }

    public function zakat()
    {
        return $this->belongsTo(Zakat::class, 'zakat_id');
    }

    public function akunbank()
    {
        return $this->belongsTo(AkunBank::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($pembayaran) {
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
            // Cek jumlah pembayaran pada hari yang sama
            $countToday = Pembayaran::whereDate('created_at', now()->toDateString())->count() + 1;

            $kodeUrut = str_pad($countToday, 6, '0', STR_PAD_LEFT); // jadikan 0000001, 0000002, dst
            $pembayaran->kode_pembayaran = $tanggal . '/' . 'PZ/' . $kodeBulan . '/' .  $kodeUrut;
        });
    }
}
