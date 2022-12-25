<?php

use App\Http\Livewire\Landing;
use App\Http\Livewire\Premium;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Livewire\Course\Coursedetails;
use App\Http\Livewire\Course\Topic\Viewtopic;
use App\Http\Livewire\Course\Topic\Quiz\Startquiz;

Route::get('/', Landing::class)->name('landing');

Route::get('/premium', Premium::class)->name('premium');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('course')->name('course.')->group(function () {
    Route::get('/{course:key}', Coursedetails::class)->name('course_details');
    Route::get('/{course:key}/topic/{topic:key}', Viewtopic::class)->name('topic');
    Route::get('/{topic:key}/quiz/{quiz:key}', Startquiz::class)->name('start_quiz');
    // Route::get('/{topic:key}/discussion', Discussion::class)->name('topic_discussion');
});

require __DIR__.'/auth.php';
