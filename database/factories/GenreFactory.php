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
        $random = $this->faker->unique()->randomElement(['Bikini', 'Blowjob', 'Glasses', 'Handjob', 'Muscle', 'Swimsuit', 'Group', 'Big Breast', 'Milf', 'Masturbation', 'Sweating', 'Sole Male', 'Pregnant', 'Sole Female']);
        return [
            'name' => $random,
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
