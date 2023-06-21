<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'isbn' => fake()->unique()->randomNumber(),
            'value' => fake()->randomDigit()
        ];
    }
}
