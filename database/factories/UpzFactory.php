<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Upz>
 */
class UpzFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kategoriupz_id' => mt_rand(2, 6),
            'nama_upz' => $this->faker->company(),
            'npwp' => $this->faker->numberBetween(),
            'no_pengukuhan' => $this->faker->numberBetween(),
            'tgl_pengukuhan' => $this->faker->date(),
            'alamat' => $this->faker->address(),
            'telepon' => $this->faker->phoneNumber(),
            'fax' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
        ];
    }
}
