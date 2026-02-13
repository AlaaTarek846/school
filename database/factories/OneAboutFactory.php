<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OneAbout>
 */
class OneAboutFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title_ar' => $this->faker->sentence(3),
            'title_en' => $this->faker->sentence(3),
            'title_color_ar' => $this->faker->sentence(1),
            'title_color_en' => $this->faker->sentence(1),
            'description_ar' => $this->faker->paragraph(),
            'description_en' => $this->faker->paragraph(),
            'years_experience' => $this->faker->numberBetween(1, 50),
            'url' => $this->faker->url(),
        ];
    }
}
