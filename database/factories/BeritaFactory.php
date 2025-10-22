<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Berita>
 */
class BeritaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'judul_berita' => $this->faker->sentence,
            'deskripsi' => $this->faker->paragraphs(3, true),
            'foto_berita' => 'berita/placeholder.svg',
        ];
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> cabang1
