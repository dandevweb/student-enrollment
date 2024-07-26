<?php

namespace App\Models;

use App\Enums\{GradeEnum, SegmentEnum};
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    protected $casts = [
        'segment' => SegmentEnum::class,
        'grade'   => GradeEnum::class,
    ];

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }
}
