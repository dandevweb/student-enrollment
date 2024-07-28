<?php

use Livewire\Livewire;
use App\Enums\RoleEnum;
use App\Livewire\{Students};

use App\Models\{Student, User};

use Illuminate\Pagination\LengthAwarePaginator;

use function Pest\Laravel\{actingAs};

beforeEach(function () {
    $this->user = User::factory()->create([
        'role' => RoleEnum::Secretary,
    ]);
    ;
});


it('should be able to access the route students', function () {
    actingAs($this->user)->get(route('students'))->assertOk();
});

test("let's create a livewire component to list all students in the page", function () {
    actingAs($this->user);
    $students = Student::factory()->count(10)->create();

    $lw = Livewire::test(Students\Index::class);

    $lw->assertSet('students', function ($items) {
        expect($items)
        ->toHaveCount(10);

        return true;
    });

    foreach ($students as $student) {
        $lw->assertSee($student->full_name);
    }
});

it('should be able to paginate the result', function () {
    Student::factory(30)->create();

    actingAs($this->user);

    Livewire::test(Students\Index::class)
        ->assertSet('students', function (LengthAwarePaginator $items) {
            expect($items)
                ->toHaveCount(config('app.per_page.default'));

            return true;
        });

});

it('should display students across multiple pages', function () {
    actingAs($this->user);

    Student::factory()->count(30)->create();

    $lw = Livewire::test(Students\Index::class)
        ->call('gotoPage', 2);

    $students = Student::latest()->skip(config('app.per_page.default'))->take(config('app.per_page.default'))->get();

    foreach ($students as $student) {
        $lw->assertSee($student->full_name);
    }
});
