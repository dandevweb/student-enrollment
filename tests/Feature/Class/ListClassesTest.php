<?php

use App\Enums\RoleEnum;
use Livewire\Livewire;
use App\Livewire\{Classes};

use App\Models\{ClassModel, User};

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

use function Pest\Laravel\{actingAs};

beforeEach(function () {
    $this->user = User::factory()->create([
        'role' => RoleEnum::Secretary,
    ]);
});

it('should be able to access the route classes', function () {
    actingAs($this->user)->get(route('classes'))->assertOk();
});

test("let's create a livewire component to list all classes in the page", function () {
    actingAs(User::factory()->create());
    $classes = ClassModel::factory()->count(10)->create();

    $lw = Livewire::test(Classes\Index::class);

    $lw->assertSet('classes', function ($items) {
        expect($items)
        ->toHaveCount(10);

        return true;
    });

    foreach ($classes as $class) {
        $lw->assertSee($class->full_name);
    }
});

it('should be able to paginate the result', function () {
    ClassModel::factory(30)->create();

    actingAs($this->user);

    Livewire::test(Classes\Index::class)
        ->assertSet('classes', function (LengthAwarePaginator $items) {
            expect($items)
                ->toHaveCount(config('app.per_page.default'));

            return true;
        });

});

it('should display classes across multiple pages', function () {
    actingAs($this->user);

    ClassModel::factory()->count(30)->create();

    $lw = Livewire::test(Classes\Index::class)
        ->call('gotoPage', 2);

    $classes = ClassModel::latest()->skip(config('app.per_page.default'))->take(config('app.per_page.default'))->get();

    foreach ($classes as $class) {
        $lw->assertSee($class->name);
    }
});
