<?php

namespace App\Livewire;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use App\Enums\GradeEnum;
use Illuminate\View\View;
use App\Models\{ClassModel, Enrollment, Student};
use Livewire\Attributes\Computed;

class EnrollStudents extends Component
{
    use LivewireAlert;

    public ?GradeEnum $grade = null;
    public $students         = [];
    public $classes          = [];

    public function render(): View
    {
        return view('livewire.enroll-students');
    }

    public function updatedGrade(): void
    {
        $this->queryStudents();

        $this->queryClasses();
    }

    public function enrollStudent(
        array $studentsFromIds,
        array $studentsToIds,
        $classFromId = null,
        $classToId = null
    ) {
        $isReorderInClass  = $classFromId === $classToId && (int)$classToId !== 0;
        $isReorderStudents = $classFromId === $classToId && (int)$classToId === 0;

        if($isReorderInClass) {
            $enrollments = Enrollment::where('class_id', $classFromId)->get();
            foreach ($studentsToIds as $index => $studentId) {
                $enrollment           = $enrollments->where('student_id', $studentId)->first();
                $enrollment->position = $index;
                $enrollment->save();
            }

            $this->updatedGrade();
            return;
        }

        if($isReorderStudents) {

            foreach ($studentsToIds as $index => $studentId) {
                $student           = Student::find($studentId);
                $student->position = $index;
                $student->save();
            }

            $this->updatedGrade();
            return;
        }

        if (!$classFromId) {
            $classTo = ClassModel::where('grade', $this->grade)->find($classToId);
            if ($this->verifyClassLimit($classTo, count($studentsToIds))) {
                $classTo->students()->sync($studentsToIds);
                $this->updatedGrade();
            }

            return;
        }

        if (!$classToId) {
            $classFrom = ClassModel::where('grade', $this->grade)->find($classFromId);
            $classFrom->students()->sync($studentsFromIds);

            $this->updatedGrade();
            return;
        }

        if((int)$classFromId !== 0 && (int)$classToId !== 0) {
            $classFrom = ClassModel::where('grade', $this->grade)->find($classFromId);
            $classTo   = ClassModel::where('grade', $this->grade)->find($classToId);

            if ($this->verifyClassLimit($classTo, count($studentsToIds))) {
                $classFrom->students()->sync($studentsFromIds);
                $classTo->students()->sync($studentsToIds);

                $this->updatedGrade();
            }
        }
    }

    public function updateClassesOrder(array $classIds): void
    {
        $classIds = array_filter($classIds);

        foreach ($classIds as $index => $classId) {
            $class           = ClassModel::find($classId);
            $class->position = $index;
            $class->save();
        }

        $this->updatedGrade();
    }

    private function queryStudents()
    {
        $this->students = Student::where('grade', $this->grade)
                            ->whereDoesntHave('enrollments', function ($query) {
                                $query->where('grade', $this->grade);
                            })
                            ->orderBy('position')
                            ->get();
    }

    private function queryClasses(): void
    {
        $this->classes = ClassModel::where('grade', $this->grade)
                            ->with(['students' => function ($query) {
                                $query->withPivot('position')
                                      ->orderBy('pivot_position');
                            }])
                            ->orderBy('position')
                            ->orderBy('shift')
                            ->get();

    }

    private function verifyClassLimit(ClassModel $class, int $newStudentsCount): bool
    {
        if ($newStudentsCount > $class->vacancies) {
            $this->alert('error', 'Classe com limite de alunos atingido!');
            return false;
        }
        return true;
    }

    #[Computed]
    public function grades(): array
    {
        return GradeEnum::arrayToSelect();
    }
}
