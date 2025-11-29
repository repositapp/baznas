<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pembayaran>
 */
class PembayaranFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
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

        return [
            'upz_id' => mt_rand(1, 31),
            'amil_id' => 3,
            'muzaki_id' => mt_rand(1, 200),
            'zakat_id' => 1,
            'kode_pembayaran' => $this->faker->numerify($tanggal . 'PZ/' . $kodeBulan . '/#####' . mt_rand(1, 200)),
            'tgl_bayar' => now(),
            'jenis_pembayaran' => 'Zakat Fitrah',
            'metode_bayar' => 'Beras',
            'nilai_ukur' => 2.5,
            'jumlah_keluarga' => 4,
            'total' => 10,
        ];
    }
}
