<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Series>
 */
class SeriesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
           'title' => $this->faker->word(),
           'slug' => $this->faker->slug(),
           'overview' => $this->faker->paragraph(4),
           'status' => $this->faker->randomElement(['pending', 'finish', 'ongoing']),
           'published_day' => $this->faker->randomElement(['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday']),
           'original_title' => $this->faker->word(),
           'gallery_id' => '1',
           'category_id' => $this->faker->numberBetween(1, 10)
        ];
    }
}
