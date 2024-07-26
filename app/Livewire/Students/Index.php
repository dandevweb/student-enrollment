<?php

namespace App\Livewire\Students;

use App\Models\Student;
use Livewire\{Component, WithPagination};
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class Index extends Component
{
    use WithPagination;

    public ?string $search = null;

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
}
