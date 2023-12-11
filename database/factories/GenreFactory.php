<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Genre>
 */
class GenreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement(['Bikini', 'Blowjob', 'Glases', 'Hanjob', 'Muscle', 'Swimsuit', 'Group']), 
            'slug' => $this->faker->slug(),
            'primary_color' => $this->faker->randomElement([
                '#1a3bcf',
                '#7e9df5',
                '#4cfaa7',
                '#ff61a2',
                '#9c2af5',
                '#3efc5e',
                '#f94c84',
                '#76fc2e',
                '#c71e5c',
                '#2efc80'
            ])
        ];
    }
}
