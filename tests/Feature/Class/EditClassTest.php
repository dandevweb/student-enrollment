<?php

use Livewire\Livewire;
use App\Enums\ShiftEnum;

use App\Models\{ClassModel, User};
use App\Livewire\Classes;
use App\Enums\{GradeEnum};

use function Pest\Laravel\{actingAs, assertDatabaseHas};

beforeEach(function () {
    actingAs(User::factory()->create());
    $this->class = ClassModel::factory()->create();
});

it('should be able to updated a class', function () {
    Livewire::test(Classes\Form::class)
        ->set('class', $this->class)
        ->set('form.name', 'John Doe')
        ->assertPropertyWired('form.name')
        ->set('form.shift', ShiftEnum::Morning)
        ->assertPropertyWired('form.shift')
        ->set('form.vacancies', 25)
        ->assertPropertyWired('form.vacancies')
        ->set('form.school_year', '2025')
        ->assertPropertyWired('form.school_year')
        ->set('form.grade', GradeEnum::G2)
        ->assertPropertyWired('form.grade')
        ->call('save')
        ->assertMethodWiredToForm('save')
        ->assertHasNoErrors();

    assertDatabaseHas('classes', [
        'name'        => 'John Doe',
        'shift'       => ShiftEnum::Morning,
        'vacancies'   => 25,
        'school_year' => '2025',
        'grade'       => GradeEnum::G2,
    ]);
});

describe('validations', function () {
    test('name should required', function ($rule, $value) {
        Livewire::test(Classes\Form::class)
            ->set('form.name', $value)
            ->call('save')
            ->assertHasErrors(['form.name' => $rule]);
    })->with([
        'required' => ['required', ''],
        'max'      => ['max', str_repeat('a', 256)],
    ]);

    test('shift should required', function ($rule, $value) {
        Livewire::test(Classes\Form::class)
            ->set('form.shift', $value)
            ->call('save')
            ->assertHasErrors(['form.shift' => $rule]);
    })->with([
        'required' => ['required', ''],
    ]);

    test('vacancies should required', function ($rule, $value) {
        Livewire::test(Classes\Form::class)
            ->set('form.vacancies', $value)
            ->call('save')
            ->assertHasErrors(['form.vacancies' => $rule]);
    })->with([
        'required' => ['required', ''],
    ]);

    test('school_year should required', function ($rule, $value) {
        Livewire::test(Classes\Form::class)
            ->set('form.school_year', $value)
            ->call('save')
            ->assertHasErrors(['form.school_year' => $rule]);
    })->with([
        'required' => ['required', ''],
    ]);

    test('grade should required', function ($rule, $value) {
        Livewire::test(Classes\Form::class)
            ->set('form.grade', $value)
            ->call('save')
            ->assertHasErrors(['form.grade' => $rule]);
    })->with([
        'required' => ['required', ''],
    ]);
});
