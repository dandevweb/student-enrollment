<?php

use App\Enums\{GradeEnum, SegmentEnum};

if (! function_exists('user')) {

    function user(): ?\App\Models\User
    {
        return auth()->user();
    }
}

if (! function_exists('deleteOptions')) {
    function deleteOptions(array $options = []): array
    {
        return !empty($options) ? $options : [
            'text'              => 'Após a confirmação, esse processo não poderá ser revertido!',
            'onConfirmed'       => 'confirmed',
            'cancelButtonText'  => 'Cancelar',
            'confirmButtonText' => 'Sim',
            "confirmButton"     => "btn btn-danger",
            "cancelButton"      => "btn btn-secondary"
        ];
    }
}

if(! function_exists('setSegment')) {
    function setSegment(GradeEnum $grade): SegmentEnum
    {
        return match($grade) {
            GradeEnum::G1,
            GradeEnum::G2,
            GradeEnum::G3 => SegmentEnum::Childish,

            GradeEnum::First,
            GradeEnum::Second,
            GradeEnum::Third,
            GradeEnum::Fourth,
            GradeEnum::Fifth => SegmentEnum::EarlyYears,

            GradeEnum::Sixth,
            GradeEnum::Seventh,
            GradeEnum::Eighth,
            GradeEnum::Ninth => SegmentEnum::MiddleYears,

            GradeEnum::FirstYearHS,
            GradeEnum::SecondYearHS,
            GradeEnum::ThirdYearHS => SegmentEnum::HighSchool,
        };
    }
}
