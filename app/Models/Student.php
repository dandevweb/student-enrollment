<?php

namespace App\Models;

use App\Enums\{GradeEnum, SegmentEnum};
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    protected $casts = [
        'segment' => SegmentEnum::class,
        'grade'   => GradeEnum::class,
    ];

    protected function registration(): Attribute
    {
        return Attribute::make(
            get: fn () => str_pad((string)$this->id, 5, '0', STR_PAD_LEFT),
        );
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }
}
