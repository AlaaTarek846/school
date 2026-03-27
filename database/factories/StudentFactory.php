<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StudentFactory extends Factory
{
    protected $model = Student::class;

    public function definition(): array
    {
        $gender = $this->faker->randomElement(['male', 'female']);
        
        return [
            'username' => $this->faker->unique()->userName(),
            'name' => $this->faker->name($gender),
            'password' => Hash::make('12345678'),
            'code' => $this->faker->unique()->numberBetween(1000000, 9999999),
            'email' => $this->faker->unique()->safeEmail(),
            'phone_1' => $this->faker->phoneNumber(),
            'phone_2' => $this->faker->phoneNumber(),
            'governorate' => $this->faker->city(),
            'city' => $this->faker->city(),
            'address' => $this->faker->address(),
            'gender' => $gender,
            'birth_day' => $this->faker->date('Y-m-d', '-5 years'),
            'is_active' => true,
            'is_completed' => false,
        ];
    }
}
