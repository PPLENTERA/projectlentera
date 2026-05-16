<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Feedback>
 */
class FeedbackFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_lengkap' => $this->faker->name(),
            'nomor_telepon' => $this->faker->phoneNumber(),
            'kategori_masukan' => $this->faker->randomElement(['Saran', 'Laporan', 'Keluhan', 'Pertanyaan']),
            'deskripsi_masukan' => $this->faker->paragraph(),
            'status' => 'belum_ditinjau',
        ];
    }
}
