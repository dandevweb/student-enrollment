<?php

use Livewire\Livewire;
use App\Enums\RoleEnum;
use App\Livewire\Classes\Index;

use App\Models\{ClassModel, User};

use function Pest\Laravel\{actingAs, assertDatabaseMissing};

it('should be able to delete a class', function () {
    actingAs(User::factory()->create([
        'role' => RoleEnum::Secretary,
    ]));
    $class = ClassModel::factory()->create();
    Livewire::test(Index::class)
        ->set('modelId', $class->id)
        ->call('delete');

    assertDatabaseMissing('classes', ['id' => $class->id]);
});
