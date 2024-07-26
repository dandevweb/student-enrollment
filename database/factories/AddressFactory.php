<?php

namespace Database\Factories;

use App\Models\Student;
use App\Enums\AddressTypeEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    public function definition(): array
    {
        return [
            'student_id' => Student::factory(),
            'type'       => $this->faker->randomElement(AddressTypeEnum::values()),
            'street'     => $this->faker->streetName,
            'zip_code'   => $this->faker->postcode,
            'number'     => $this->faker->buildingNumber,
            'complement' => $this->faker->secondaryAddress,
        ];
    }
}
