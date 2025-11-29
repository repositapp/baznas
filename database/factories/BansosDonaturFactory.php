<?php

namespace Database\Factories;

use App\Models\Akunbank;
use App\Models\Bansos;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BansosDonatur>
 */
class BansosdonaturFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'bansos_id' => Bansos::inRandomOrder()->value('id'),
            'akunbank_id' => Akunbank::inRandomOrder()->value('id'),
            'nama' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'telepon' => $this->faker->phoneNumber(),
            'komentar' => $this->faker->optional()->sentence(),
            'nominal_donasi' => $this->faker->numberBetween(100_000, 2_000_000),
            'image' => 'bukti-transfer/YquCMxH2FLVr8IvWKkujMc73ibEbmwOhBq0r9thb.png',
            'status' => true,
        ];
    }
}
