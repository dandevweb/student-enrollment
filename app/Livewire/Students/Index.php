<?php

namespace App\Livewire\Students;

use App\Models\Student;
use Livewire\Component;
use Illuminate\View\View;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Illuminate\Database\Eloquent\Collection;
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
                fn ($query, $search) => $query->where('full_name', 'like', "%$search%"))
            ->paginate(5);
    }
}
