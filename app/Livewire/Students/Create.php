<?php

namespace App\Livewire\Students;

use App\Enums\{AddressTypeEnum, GradeEnum, SegmentEnum};
use App\Livewire\Forms\StudentForm;
use App\Models\Student;
use Illuminate\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Computed;
use LivewireUI\Modal\ModalComponent;

class Create extends ModalComponent
{
    use LivewireAlert;

    public StudentForm $form;

    public function render(): View
    {
        return view('livewire.students.create');
    }

    public function save(): void
    {
        $this->validate();

        $data = $this->form->toArray();

        $data['segment'] = $this->setSegment($data['grade']);

        Student::create($data);

        $this->flash('success', 'Aluno criado com sucesso!', redirect: route('students'));
        $this->closeModal();
    }

    #[Computed]
    public function grades(): array
    {
        return GradeEnum::arrayToSelect();
    }

    #[Computed]
    public function addressTypes(): array
    {
        return AddressTypeEnum::arrayToSelect();
    }

    public function setSegment(int $grade)
    {
        return match($grade) {
            GradeEnum::G1->value,
            GradeEnum::G2->value,
            GradeEnum::G3->value => SegmentEnum::Childish,

            GradeEnum::First->value,
            GradeEnum::Second->value,
            GradeEnum::Third->value,
            GradeEnum::Fourth->value,
            GradeEnum::Fifth->value => SegmentEnum::EarlyYears,

            GradeEnum::Sixth->value,
            GradeEnum::Seventh->value,
            GradeEnum::Eighth->value,
            GradeEnum::Ninth->value => SegmentEnum::MiddleYears,

            GradeEnum::FirstYearHS->value,
            GradeEnum::SecondYearHS->value,
            GradeEnum::ThirdYearHS->value => SegmentEnum::HighSchool,

            default => SegmentEnum::Childish,
        };
    }

    public static function modalMaxWidth(): string
    {
        return '7xl';
    }
}
