<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CampusTour>
 */
class CampusTourFactory extends Factory
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
            'description_ar' => $this->faker->paragraph(),
            'description_en' => $this->faker->paragraph(),
            'image' => '/storage/placeholders/campus.jpg', // Static placeholder
            'link' => $this->faker->url(),
        ];
    }
}
