<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\Student;
use App\Enums\{AddressTypeEnum, GradeEnum, SegmentEnum};
use Livewire\Attributes\Validate;

class StudentForm extends Form
{
    #[Validate(['required', 'string', 'max:255'])]
    public string $full_name;

    #[Validate(['required', 'date'])]
    public string $birth_date;

    #[Validate(['required'])]
    public GradeEnum $grade;

    #[Validate(['required', 'string', 'max:255'])]
    public string $father_name;

    #[Validate(['required', 'string', 'max:255'])]
    public string $mother_name;

    #[Validate(['required'])]
    public AddressTypeEnum $address_type;

    #[Validate(['required', 'string', 'max:255'])]
    public string $street;

    #[Validate(['required', 'string', 'max:255'])]
    public string $zip_code;

    #[Validate(['required', 'string', 'max:255'])]
    public string $number;

    #[Validate(['nullable', 'string', 'max:255'])]
    public ?string $complement = null;

    public function setStudent(Student $student): void
    {
        $this->full_name    = $student->full_name;
        $this->birth_date   = $student->birth_date->format('Y-m-d');
        $this->grade        = $student->grade;
        $this->father_name  = $student->father_name;
        $this->mother_name  = $student->mother_name;
        $this->address_type = $student->address_type;
        $this->street       = $student->street;
        $this->zip_code     = $student->zip_code;
        $this->number       = $student->number;
        $this->complement   = $student->complement;
    }

    public function setSegment(GradeEnum $grade)
    {
        return match($grade) {
            GradeEnum::G1,
            GradeEnum::G2,
            GradeEnum::G3 => SegmentEnum::Childish,

            GradeEnum::First,
            GradeEnum::Second,
            GradeEnum::Third,
            GradeEnum::Fourth,
            GradeEnum::Fifth => SegmentEnum::EarlyYears,

            GradeEnum::Sixth,
            GradeEnum::Seventh,
            GradeEnum::Eighth,
            GradeEnum::Ninth => SegmentEnum::MiddleYears,

            GradeEnum::FirstYearHS,
            GradeEnum::SecondYearHS,
            GradeEnum::ThirdYearHS => SegmentEnum::HighSchool,
        };
    }
}
