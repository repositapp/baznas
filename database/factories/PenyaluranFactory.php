<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Penyaluran>
 */
class PenyaluranFactory extends Factory
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
            'mustahik_id' => mt_rand(1, 100),
            'zakat_id' => 1,
            'kode_penyaluran' => $this->faker->numerify($tanggal . 'PYZ/' . $kodeBulan . '/#####' . mt_rand(1, 100)),
            'tgl_penyaluran' => now(),
            'total' => 2.5 * mt_rand(1, 5),
        ];
    }
}
