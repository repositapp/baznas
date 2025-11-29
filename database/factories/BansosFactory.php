<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bansos>
 */
class BansosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'upz_id' => 1,
            'amil_id' => 1,
            'title' => $this->faker->sentence(mt_rand(2, 8)),
            'slug' => $this->faker->slug(),
            'body' => $this->faker->paragraph(mt_rand(80, 100)),
            'range_start' => '2025-07-01',
            'range_end' => '2025-08-31',
            'jumlah_donasi' => $this->faker->numberBetween(60000000, 150000000),
            'image' => 'bansos-images/coba-saja.png',
            'status' => 1,
        ];
    }
}
