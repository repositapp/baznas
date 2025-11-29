<?php

namespace Database\Factories;

use App\Models\Bansos;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BansosSaluran>
 */
class BansossaluranFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $bansos = Bansos::inRandomOrder()->with('bansosdonaturs')->first();
        $total_donasi = $bansos?->bansosdonaturs->sum('nominal_donasi') ?? 0;

        return [
            'bansos_id' => $bansos?->id,
            'title' => $this->faker->sentence(3),
            'jumlah_penerima' => $this->faker->numberBetween(1, 30),
            'total_nominal' => $this->faker->numberBetween(10_000, $total_donasi > 0 ? (int) $total_donasi : 10_000),
            'body' => $this->faker->paragraph(),
        ];
    }
}
