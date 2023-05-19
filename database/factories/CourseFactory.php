<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Curso>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name" => $this->faker->words(2, true),
            "hours" => $this->faker->randomNumber(2, false),
            "price" => $this->faker->randomNumber(2, false),
            "percent_teacher" => $this->faker->numberBetween(10, 20),
            "start_date" => $this->faker->dateTimeBetween('-1 week', '+1 week'),
            "finish_date" => $this->faker->dateTimeThisYear('+1 months'),
        ];
    }
}
