<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Livewire\{
    Students,
    Classes,
    EnrollStudents,
    Reports,
};

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/students', Students\Index::class)->name('students');
    Route::get('classes', Classes\Index::class)->name('classes');
    Route::get('enroll', EnrollStudents::class)->name('enroll');
    Route::get('reports', Reports\Index::class)->name('reports');
});

require __DIR__ . '/auth.php';
