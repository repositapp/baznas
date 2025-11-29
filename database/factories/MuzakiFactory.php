<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Muzaki>
 */
class MuzakiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $gender = $this->faker->randomElement(['Laki-Laki', 'Perempuan']);
        return [
            'upz_id' => mt_rand(1, 31),
            'nama' => $this->faker->name($gender),
            'nik' => $this->faker->nik(),
            'tempat_lahir' => $this->faker->address(),
            'tanggal_lahir' => $this->faker->date(),
            'jenis_kelamin' => $gender,
            'pekerjaan' => $this->faker->jobTitle(),
            'alamat_kantor' => $this->faker->address(),
            'alamat_rumah' => $this->faker->address(),
            'telepon' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
        ];
    }
}
