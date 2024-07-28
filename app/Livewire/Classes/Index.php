<?php

namespace App\Livewire\Classes;

use Livewire\{Component, WithPagination};
use Livewire\Attributes\{Computed, On};
use Illuminate\View\View;
use App\Models\ClassModel;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class Index extends Component
{
    use LivewireAlert;
    use WithPagination;

    public ?string $search = null;
    public ?int $modelId   = null;

    public function mount(): void
    {
        if(user()->isRegister()) {
            abort(403);
        }
    }

    public function render(): View
    {
        return view('livewire.classes.index');
    }

    #[Computed]
    public function classes(): LengthAwarePaginator
    {
        return ClassModel::query()
            ->latest()
            ->paginate(10);
    }

    public function tryDelete(int $id): void
    {
        $this->modelId = $id;
        $this->confirm('Tem certeza?', deleteOptions());
    }

    #[On('confirmed')]
    public function delete(): void
    {
        ClassModel::findOrFail($this->modelId)->delete();

        $this->alert('success', 'Turma excluída com sucesso!');
    }
}
