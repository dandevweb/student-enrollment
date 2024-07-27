<?php

namespace App\Livewire\Reports;

use App\Models\Student;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Illuminate\Database\Eloquent\Collection;

class Brothers extends Component
{
    public ?string $search = null;

    public function render()
    {
        return view('livewire.reports.brothers');
    }

    #[Computed]
    public function students(): Collection|array
    {
        if(!$this->search) {
            return [];
        }

        return Student::query()
            ->where(
                fn ($query) => $query
                ->where('mother_name', 'like', "%{$this->search}%")
                ->orWhere('father_name', 'like', "%{$this->search}%")
            )
            ->with('classes')
            ->get();
    }
}
