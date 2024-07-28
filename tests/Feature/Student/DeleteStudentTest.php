<?php

use Livewire\Livewire;
use App\Models\{Student, User};
use App\Livewire\Students\Index;

use function Pest\Laravel\{actingAs, assertDatabaseMissing};

beforeEach(function () {
    actingAs(User::factory()->create());
    $this->student = Student::factory()->create();
});

it('should be able to archive a student', function () {
    Livewire::test(Index::class)
        ->set('modelId', $this->student->id)
        ->call('delete');

    assertDatabaseMissing('students', ['id' => $this->student->id]);
});
