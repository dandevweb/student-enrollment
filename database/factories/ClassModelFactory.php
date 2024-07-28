<?php

namespace Database\Factories;

use App\Enums\{GradeEnum, ShiftEnum};
use Illuminate\Database\Eloquent\Factories\Factory;

class ClassModelFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name'        => strtoupper($this->faker->randomLetter()),
            'shift'       => $this->faker->randomElement(ShiftEnum::values()),
            'vacancies'   => $this->faker->numberBetween(10, 30),
            'school_year' => $this->faker->year,
            'grade'       => $this->faker->randomElement(GradeEnum::values()),
            'position'    => $this->faker->numberBetween(1, 100),
        ];
    }
}
