<?php

use App\Http\Controllers\IdeaController;
use App\Http\Controllers\ProfileController;
use App\Http\Livewire\Auth\Createcourse;
use App\Http\Livewire\Auth\CreateQuestion;
use App\Http\Livewire\Auth\CreateTopic;
use App\Http\Livewire\Auth\MyCourses;
use App\Http\Livewire\Auth\ViewCourse;
use App\Http\Livewire\Auth\ViewCourseTopic;
use App\Http\Livewire\Auth\ViewTopicQuizzes;
use App\Http\Livewire\Course\Coursedetails;
use App\Http\Livewire\Course\Topic\Quiz\Startquiz;
use App\Http\Livewire\Course\Topic\Viewtopic;
use App\Http\Livewire\Landing;
use App\Http\Livewire\Premium;
use Illuminate\Support\Facades\Route;

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

// Route::middleware(['auth'])->prefix('auth')->name('auth.')->group(function () {
//     Route::get('/courses', MyCourses::class)->name('usercourses');
//     Route::get('/create', Createcourse::class)->name('createcourse');
//     Route::get('/course/{course:key}', ViewCourse::class)->name('view-course');
//     Route::get('/course/{course:key}/create-topic', CreateTopic::class)->name('create-topic');
//     Route::get('/course/{course:key}/topic/{topic:key}', ViewCourseTopic::class)->name('view-course-topic');
//     Route::get('/topic/{topic:key}/quizes', ViewTopicQuizzes::class)->name('view-topic-quizzes');
//     Route::get('/{quiz:key}/create-question', CreateQuestion::class)->name('create-question');
// });

Route::prefix('course')->name('course.')->group(function () {
    Route::get('/{course:key}', Coursedetails::class)->name('course_details');
    Route::get('/{course:key}/topic/{topic:key}', Viewtopic::class)->name('topic');
    Route::get('/{topic:key}/quiz/{quiz:key}', Startquiz::class)->name('start_quiz');
    // Route::get('/{topic:key}/discussion', Discussion::class)->name('topic_discussion');
});

Route::get('/topic/{topic:key}/idea', [IdeaController::class, 'index'])->name('idea.index');
Route::get('/topic/{topic:key}/ideas/{idea:slug}', [IdeaController::class, 'show'])->name('idea.show');

require __DIR__.'/auth.php';
