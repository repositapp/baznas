<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mustahik>
 */
class MustahikFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $gender = $this->faker->randomElement(['Laki-Laki', 'Perempuan']);
        $jobtitle = $this->faker->randomElement(['Buruh Tani', 'Nelayan', 'Buruh Bangunan', 'Buruh Pabrik', 'Pemulung', 'Petani Lahan Kecil', 'Penenun', 'Tukang Ojek']);
        return [
            'upz_id' => mt_rand(1, 31),
            'golongan_id' => mt_rand(1, 8),
            'nama' => $this->faker->name($gender),
            'nik' => $this->faker->nik(),
            'anggota_keluarga' => mt_rand(1, 3),
            'tempat_lahir' => $this->faker->address(),
            'tanggal_lahir' => $this->faker->date(),
            'jenis_kelamin' => $gender,
            'pekerjaan' => $jobtitle,
            'alamat_rumah' => $this->faker->address(),
            'telepon' => $this->faker->phoneNumber(),
        ];
    }
}
