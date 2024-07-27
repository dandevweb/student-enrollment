<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        Student::factory()->count(300)->create();

        Student::all()->each(function ($student) {
            $student->update([
                'grade'   => $student->grade,
                'segment' => setSegment($student->grade),
            ]);
        });
    }
}
