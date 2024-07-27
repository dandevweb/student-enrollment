<?php

namespace App\Livewire\Students;

use App\Models\Student;
use Illuminate\View\View;
use App\Enums\{AddressTypeEnum, GradeEnum};
use Livewire\Attributes\Computed;
use App\Livewire\Forms\StudentForm;
use LivewireUI\Modal\ModalComponent;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Form extends ModalComponent
{
    use LivewireAlert;

    public StudentForm $form;
    public ?Student $student = null;

    public function mount(): void
    {
        if($this->student) {
            $this->form->setStudent($this->student);
        }
    }

    public function render(): View
    {
        return view('livewire.students.form');
    }

    public function save(): void
    {
        $this->validate();

        $data = $this->form->toArray();

        $data['segment'] = $this->form->setSegment($data['grade']);

        $this->student ? $this->update($data) : $this->create($data);
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

    private function create(array $data): void
    {
        Student::create($data);

        $this->flash('success', 'Aluno criado com sucesso!', redirect: route('students'));
        $this->closeModal();
    }

    public function update(array $data): void
    {
        $this->student->update($data);

        $this->flash('success', 'Aluno atualizado com sucesso!', redirect: route('students'));
        $this->closeModal();
    }

    public static function modalMaxWidth(): string
    {
        return '7xl';
    }
}
