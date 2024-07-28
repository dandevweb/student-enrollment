<?php

use App\Enums\{AddressTypeEnum, GradeEnum};
use App\Models\User;
use Livewire\Livewire;
use App\Livewire\Students;

use function Pest\Laravel\{actingAs, assertDatabaseHas};

beforeEach(function () {
    actingAs(User::factory()->create());
});

it('should be able to create a student', function () {
    Livewire::test(Students\Form::class)
        ->set('form.full_name', 'John Doe')
        ->assertPropertyWired('form.full_name')
        ->set('form.birth_date', '1986-10-10')
        ->assertPropertyWired('form.birth_date')
        ->set('form.grade', GradeEnum::G1)
        ->assertPropertyWired('form.grade')
        ->set('form.father_name', 'John Doe Sr.')
        ->assertPropertyWired('form.father_name')
        ->set('form.mother_name', 'Jane Doe')
        ->assertPropertyWired('form.mother_name')
        ->set('form.address_type', AddressTypeEnum::Billing)
        ->assertPropertyWired('form.address_type')
        ->set('form.street', '123 Main St.')
        ->assertPropertyWired('form.street')
        ->set('form.number', '123')
        ->assertPropertyWired('form.number')
        ->set('form.zip_code', 'Downtown')
        ->assertPropertyWired('form.zip_code')
        ->set('form.complement', 'Apt. 123')
        ->assertPropertyWired('form.complement')
        ->call('save')
        ->assertMethodWiredToForm('save')
        ->assertHasNoErrors();

    assertDatabaseHas('students', [
        'full_name'    => 'John Doe',
        'birth_date'   => '1986-10-10',
        'grade'        => GradeEnum::G1,
        'segment'      => setSegment(GradeEnum::G1),
        'father_name'  => 'John Doe Sr.',
        'mother_name'  => 'Jane Doe',
        'address_type' => AddressTypeEnum::Billing,
        'street'       => '123 Main St.',
        'number'       => '123',
        'zip_code'     => 'Downtown',
        'complement'   => 'Apt. 123',
    ]);
});

describe('validations', function () {
    test('full_name should required', function ($rule, $value) {
        Livewire::test(Students\Form::class)
            ->set('form.full_name', $value)
            ->call('save')
            ->assertHasErrors(['form.full_name' => $rule]);
    })->with([
        'required' => ['required', ''],
        'min'      => ['min', 'Jo'],
        'max'      => ['max', str_repeat('a', 256)],
    ]);

    test('birth_date should required', function ($rule, $value) {
        Livewire::test(Students\Form::class)
            ->set('form.birth_date', $value)
            ->call('save')
            ->assertHasErrors(['form.birth_date' => $rule]);
    })->with([
        'required' => ['required', ''],
        'date'     => ['date', '123'],
    ]);

    test('grade should required', function ($rule, $value) {
        Livewire::test(Students\Form::class)
            ->set('form.grade', $value)
            ->call('save')
            ->assertHasErrors(['form.grade' => $rule]);
    })->with([
        'required' => ['required', ''],
    ]);

    test('father_name should required', function ($rule, $value) {
        Livewire::test(Students\Form::class)
            ->set('form.father_name', $value)
            ->call('save')
            ->assertHasErrors(['form.father_name' => $rule]);
    })->with([
        'required' => ['required', ''],
        'max'      => ['max', str_repeat('a', 256)],
    ]);

    test('mother_name should required', function ($rule, $value) {
        Livewire::test(Students\Form::class)
            ->set('form.mother_name', $value)
            ->call('save')
            ->assertHasErrors(['form.mother_name' => $rule]);
    })->with([
        'required' => ['required', ''],
        'max'      => ['max', str_repeat('a', 256)],
    ]);

    test('address_type should required', function ($rule, $value) {
        Livewire::test(Students\Form::class)
            ->set('form.address_type', $value)
            ->call('save')
            ->assertHasErrors(['form.address_type' => $rule]);
    })->with([
        'required' => ['required', ''],
    ]);

    test('street should required', function ($rule, $value) {
        Livewire::test(Students\Form::class)
            ->set('form.street', $value)
            ->call('save')
            ->assertHasErrors(['form.street' => $rule]);
    })->with([
        'required' => ['required', ''],
        'max'      => ['max', str_repeat('a', 256)],
    ]);

    test('zip_code should required', function ($rule, $value) {
        Livewire::test(Students\Form::class)
            ->set('form.zip_code', $value)
            ->call('save')
            ->assertHasErrors(['form.zip_code' => $rule]);
    })->with([
        'required' => ['required', ''],
        'max'      => ['max', str_repeat('a', 256)],
    ]);

    test('number should required', function ($rule, $value) {
        Livewire::test(Students\Form::class)
            ->set('form.number', $value)
            ->call('save')
            ->assertHasErrors(['form.number' => $rule]);
    })->with([
        'required' => ['required', ''],
        'max'      => ['max', str_repeat('a', 256)],
    ]);
});
