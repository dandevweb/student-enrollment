<?php

namespace App\Livewire\Classes;

use App\Enums\{GradeEnum, ShiftEnum};
use Illuminate\View\View;
use App\Models\ClassModel;
use App\Livewire\Forms\ClassForm;
use Livewire\Attributes\Computed;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use LivewireUI\Modal\ModalComponent;

class Form extends ModalComponent
{
    use LivewireAlert;

    public ClassForm $form;
    public ?ClassModel $class = null;

    public function mount(): void
    {
        if($this->class) {
            $this->form->setClass($this->class);
        }
    }

    public function render(): View
    {
        return view('livewire.classes.form');
    }

    public function save(): void
    {
        $this->validate();

        $data = $this->form->toArray();

        $this->class ? $this->update($data) : $this->create($data);
    }

    #[Computed]
    public function shifts(): array
    {
        return ShiftEnum::arrayToSelect();
    }

    #[Computed]
    public function grades(): array
    {
        return GradeEnum::arrayToSelect();
    }

    private function create(array $data): void
    {
        ClassModel::create($data);

        $this->flash('success', 'Turma criada com sucesso!', redirect: route('classes'));
        $this->closeModal();
    }

    public function update(array $data): void
    {
        $this->class->update($data);

        $this->flash('success', 'Turma atualizada com sucesso!', redirect: route('classes'));
        $this->closeModal();
    }

    public static function modalMaxWidth(): string
    {
        return '5xl';
    }
}
