<?php

namespace Database\Factories;

use App\Enums\{GradeEnum, ShiftEnum};
use Illuminate\Database\Eloquent\Factories\Factory;

class ClassesFactory extends Factory
{
    public function definition(): array
    {
        return [
            'class_name'  => $this->faker->word,
            'shift'       => $this->faker->randomElement(ShiftEnum::values()),
            'vacancies'   => $this->faker->numberBetween(1, 50),
            'school_year' => $this->faker->year,
            'grade'       => $this->faker->numberBetween(GradeEnum::values()),
        ];
    }
}
