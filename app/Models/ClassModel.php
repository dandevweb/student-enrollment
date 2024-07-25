<?php

namespace App\Models;

use App\Enums\Enums\ShiftEnum;
use App\Enums\GradeEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClassModel extends Model
{
    use HasFactory;

    protected $table = 'classes';
    protected $casts = [
        'grade' => GradeEnum::class,
        'shift' => ShiftEnum::class,
    ];

    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }
}