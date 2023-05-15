<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Guru>
 */
class GuruFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nama' => $this->faker->name,
            'nip' => $this->faker->numerify,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'),
            'tempat' => $this->faker->city,
            'tgl_lahir' => $this->faker->date(),
            'jns_kelamin' => $this->faker->randomElement(['laki-laki', 'perempuan']),
            'agama' => 'islam',
            'alamat' => $this->faker->address,
            'telepon' => $this->faker->phoneNumber,
            'kd_pos' => '11111',
        ];
    }
}
