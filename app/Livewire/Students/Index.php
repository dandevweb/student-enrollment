<?php

namespace App\Livewire\Students;

use App\Models\Student;
use Illuminate\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\{Computed, On};
use Livewire\{Component, WithPagination};
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class Index extends Component
{
    use LivewireAlert;
    use WithPagination;

    public ?string $search = null;
    public ?int $modelId   = null;

    public function render(): View
    {
        return view('livewire.students.index')->layoutData([
            'header' => 'Students',
        ]);
    }

    #[Computed]
    public function students(): LengthAwarePaginator
    {
        return Student::query()
            ->when(
                $this->search,
                fn ($query, $search) => $query->where('full_name', 'like', "%$search%")
            )
            ->latest()
            ->paginate(5);
    }

    public function tryDelete(int $id): void
    {
        $this->modelId = $id;
        $this->confirm('Tem certeza?', deleteOptions());
    }

    #[On('confirmed')]
    public function delete(): void
    {
        Student::findOrFail($this->modelId)->delete();

        $this->alert('success', 'Aluno excluído com sucesso!');
    }
}
