<?php

use Livewire\Livewire;
use App\Enums\{GradeEnum, RoleEnum};
use App\Models\{ClassModel, Enrollment, Student, User};
use App\Livewire\EnrollStudents;
use Illuminate\Database\Eloquent\Collection;

use function Pest\Laravel\{actingAs, assertDatabaseCount};

beforeEach(function () {
    actingAs(User::factory()->create([
        'role' => RoleEnum::Secretary,
    ]));
});

it('should render', function () {
    Livewire::test(EnrollStudents::class)
        ->assertOk();
});

it('should list students by grade', function () {
    Student::factory()->count(10)->create([
        'grade' => GradeEnum::G1,
    ]);

    Student::factory()->count(5)->create([
        'grade' => GradeEnum::G2,
    ]);

    Livewire::test(EnrollStudents::class)
        ->set('grade', GradeEnum::G1)
        ->assertSet('students', function (Collection $items) {
            expect($items)
                ->toHaveCount(10);

            return true;
        });

    Livewire::test(EnrollStudents::class)
        ->set('grade', GradeEnum::G2)
        ->assertSet('students', function (Collection $items) {
            expect($items)
                ->toHaveCount(5);

            return true;
        });
});

it('should list students in grade ordered by position', function () {
    $student3 = Student::factory()->create(['grade' => GradeEnum::Eighth, 'position' => 3]);
    $student5 = Student::factory()->create(['grade' => GradeEnum::Eighth, 'position' => 5]);
    $student1 = Student::factory()->create(['grade' => GradeEnum::Eighth, 'position' => 1]);
    $student2 = Student::factory()->create(['grade' => GradeEnum::Eighth, 'position' => 2]);
    $student4 = Student::factory()->create(['grade' => GradeEnum::Eighth, 'position' => 4]);

    Livewire::test(EnrollStudents::class)
        ->set('grade', GradeEnum::Eighth)
        ->assertSet('students', function (Collection $collection) use ($student1, $student2, $student3, $student4, $student5) {
            expect($collection)
            ->offsetGet(0)->id->toBe($student1->id)
            ->offsetGet(1)->id->toBe($student2->id)
            ->offsetGet(2)->id->toBe($student3->id)
            ->offsetGet(3)->id->toBe($student4->id)
            ->offsetGet(4)->id->toBe($student5->id);

            return true;
        });
});

it('must be able to update the board, enrolling students in classes', function () {
    $studentsForNinTh = Student::factory(20)->create(['grade' => GradeEnum::Ninth]);
    $studentsForG2    = Student::factory(27)->create(['grade' => GradeEnum::G3,]);

    $class1 = ClassModel::factory()->create(['grade' => GradeEnum::Ninth, 'vacancies' => 20]);
    $class2 = ClassModel::factory()->create(['grade' => GradeEnum::G3, 'vacancies' => 27]);

    Livewire::test(EnrollStudents::class)
        ->set('grade', GradeEnum::Ninth)
        ->call(
            'enrollStudent',
            $studentsForNinTh->pluck('id')->toArray(),
            $studentsForNinTh->pluck('id')->toArray(),
            null,
            $class1->id,
        )
        ->assertSet('students', function (Collection $collection) {
            expect($collection)
                ->toHaveCount(0);

            return true;
        });

    $studentsForNinTh->each(function ($student) use ($class1, $class2) {
        $this->assertDatabaseHas('enrollments', [
            'student_id' => $student->id,
            'class_id'   => $class1->id,
        ]);

        $this->assertDatabaseMissing('enrollments', [
            'student_id' => $student->id,
            'class_id'   => $class2->id,
        ]);
    });

    Livewire::test(EnrollStudents::class)
        ->set('grade', GradeEnum::G3)
        ->call(
            'enrollStudent',
            $studentsForG2->pluck('id')->toArray(),
            $studentsForG2->pluck('id')->toArray(),
            null,
            $class2->id,
        )->assertSet('students', function (Collection $collection) {
            expect($collection)
                ->toHaveCount(0);

            return true;
        });

    $studentsForG2->each(function ($student) use ($class1, $class2) {
        $this->assertDatabaseHas('enrollments', [
            'student_id' => $student->id,
            'class_id'   => $class2->id,
        ]);

        $this->assertDatabaseMissing('enrollments', [
            'student_id' => $student->id,
            'class_id'   => $class1->id,
        ]);
    });
});

it('should not be able to enroll a student in a class without vacancies', function () {
    $studentsForNinTh      = Student::factory(20)->create(['grade' => GradeEnum::Ninth]);
    $otherStudentsForNinTh = Student::factory()->create(['grade' => GradeEnum::Ninth,]);

    $class1 = ClassModel::factory()->create(['grade' => GradeEnum::Ninth, 'vacancies' => 20]);

    $studentsForNinTh->each(function ($student) use ($class1) {
        Enrollment::factory()->create([
            'student_id' => $student->id,
            'class_id'   => $class1->id,
        ]);
    });

    assertDatabaseCount('enrollments', 20);

    Livewire::test(EnrollStudents::class)
        ->set('grade', GradeEnum::Ninth)
        ->call(
            'enrollStudent',
            [$otherStudentsForNinTh->id],
            [$otherStudentsForNinTh->id, ...$studentsForNinTh->pluck('id')->toArray()],
            null,
            $class1->id,
        )->assertSet('students', function (Collection $collection) {
            expect($collection)
                ->toHaveCount(1);

            return true;
        });

    assertDatabaseCount('enrollments', 20);
});
