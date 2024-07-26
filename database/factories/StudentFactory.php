<?php

namespace Database\Factories;

use App\Enums\{GradeEnum, SegmentEnum};
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'full_name'   => $this->faker->name,
            'birth_date'  => $this->faker->date(),
            'segment'     => $this->faker->numberBetween(SegmentEnum::values()),
            'grade'       => $this->faker->numberBetween(GradeEnum::values()),
            'father_name' => $this->faker
        ];
    }
}
