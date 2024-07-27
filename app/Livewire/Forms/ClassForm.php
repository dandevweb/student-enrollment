<?php

namespace App\Livewire\Forms;

use App\Enums\{GradeEnum, ShiftEnum};
use App\Models\ClassModel;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ClassForm extends Form
{
    #[Validate(['required', 'string', 'max:255'])]
    public string $name;

    #[Validate(['required'])]
    public ShiftEnum $shift;

    #[Validate(['required', 'integer'])]
    public int $vacancies;

    #[Validate(['required', 'integer'])]
    public int $school_year;

    #[Validate(['required'])]
    public GradeEnum $grade;


    public function setClass(ClassModel $class): void
    {
        $this->name        = $class->name;
        $this->shift       = $class->shift;
        $this->vacancies   = $class->vacancies;
        $this->school_year = $class->school_year;
        $this->grade       = $class->grade;
    }
}
