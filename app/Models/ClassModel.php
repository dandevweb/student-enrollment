<?php

namespace App\Models;

use App\Enums\{GradeEnum, ShiftEnum};
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\{BelongsToMany, HasMany};
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClassModel extends Model
{
    use HasFactory;

    protected $table = 'classes';
    protected $casts = [
        'grade'       => GradeEnum::class,
        'shift'       => ShiftEnum::class,
        'school_year' => 'integer',
    ];

    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class, 'class_id');
    }

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'enrollments', 'class_id', 'student_id')
                    ->withTimestamps();
    }

    protected function shiftName(): Attribute
    {
        return Attribute::make(
            get: fn () => ShiftEnum::getDescription($this->shift->value),
        );
    }

    protected function gradeName(): Attribute
    {
        return Attribute::make(
            get: fn () => GradeEnum::getDescription($this->grade->value),
        );
    }
}
