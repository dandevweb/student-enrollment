<?php

namespace App\Livewire\Reports;

use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use App\Enums\{GradeEnum, SegmentEnum};
use App\Models\{ClassModel, Enrollment, Student};
use Illuminate\View\View;
use Livewire\Attributes\Computed;

class TotalStudents extends Component
{
    public ?GradeEnum $grade     = null;
    public ?SegmentEnum $segment = null;
    public ?int $class           = null;
    public array $grades         = [];

    public function render(): View
    {
        return view('livewire.reports.total-students');
    }

    #[Computed]
    public function segments(): array
    {
        return SegmentEnum::arrayToSelect();
    }

    public function updatedSegment(): void
    {
        $this->grade = null;

        $this->grades = $this->segment ? GradeEnum::getBySegment($this->segment) : [];
    }

    #[Computed]
    public function totalStudents(): int
    {
        return Student::query()
            ->when($this->grade, fn ($query) => $query->where('grade', $this->grade))
            ->when($this->segment, fn ($query) => $query->where('segment', $this->segment))
            ->count();
    }

    #[Computed]
    public function classes(): Collection
    {
        return ClassModel::query()
            ->orderBy('grade')
            ->get();
    }

    #[Computed]
    public function totalEnrollments()
    {
        return Enrollment::query()
            ->when($this->class, fn ($query) => $query->where('class_id', $this->class))
            ->count();
    }
}
