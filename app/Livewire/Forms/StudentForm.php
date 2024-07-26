<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class StudentForm extends Form
{
    #[Validate(['required', 'string', 'max:255'])]
    public string $full_name;

    #[Validate(['required', 'date'])]
    public string $birth_date;

    #[Validate(['required', 'integer'])]
    public int $grade;

    #[Validate(['required', 'string', 'max:255'])]
    public string $father_name;

    #[Validate(['required', 'string', 'max:255'])]
    public string $mother_name;

    #[Validate(['required', 'integer'])]
    public int $address_type;

    #[Validate(['required', 'string', 'max:255'])]
    public string $street;

    #[Validate(['required', 'string', 'max:255'])]
    public string $zip_code;

    #[Validate(['required', 'string', 'max:255'])]
    public string $number;

    #[Validate(['nullable', 'string', 'max:255'])]
    public string $complement;
}
