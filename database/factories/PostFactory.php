<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence(4);

        return [
            'title' => $title,
            'slug' => Str::slug($title), // Membuat slug berdasarkan judul
            'description' => $this->faker->paragraph(3),
            'ingredients' => $this->faker->text(200), // Teks panjang untuk bahan
            'instructions' => $this->faker->paragraphs(5, true), // 5 paragraf untuk langkah

            // Kolom opsional
            'image_url' => null,

            // Relasi (jika tidak di-override saat dipanggil)
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
