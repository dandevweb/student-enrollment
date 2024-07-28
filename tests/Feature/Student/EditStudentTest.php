<?php

use Livewire\Livewire;
use App\Livewire\Students;
use App\Enums\{AddressTypeEnum, GradeEnum};
use App\Models\{Student, User};

use function Pest\Laravel\{actingAs, assertDatabaseHas};

beforeEach(function () {
    actingAs(User::factory()->create());
    $this->student = Student::factory()->create();
});

it('should be able to updated a student', function () {
    Livewire::test(Students\Form::class)
        ->set('student', $this->student)
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
        'id'           => $this->student->id,
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
