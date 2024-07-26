<?php

namespace Database\Factories;

use App\Models\{ClassModel, Student};
use Illuminate\Database\Eloquent\Factories\Factory;

class EnrollmentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'student_id' => Student::factory(),
            'class_id'   => ClassModel::factory(),
        ];
    }
}
