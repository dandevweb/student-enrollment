<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{DashboardController, ProfileController};
use App\Livewire\{
    Students,
    Classes,
    EnrollStudents,
};

Route::middleware('auth')->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/students', Students\Index::class)->name('students');
    Route::get('classes', Classes\Index::class)->name('classes');
    Route::get('enroll', EnrollStudents::class)->name('enroll');
});

require __DIR__ . '/auth.php';
