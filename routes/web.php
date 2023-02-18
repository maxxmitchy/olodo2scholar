<?php

use App\Http\Livewire\Landing;
use App\Http\Livewire\Premium;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Auth\CreateTopic;
use App\Http\Controllers\IdeaController;
use App\Http\Livewire\Auth\Createcourse;
use App\Http\Livewire\Auth\EditQuestion;
use App\Http\Livewire\Auth\QuestionBank;
use App\Http\Livewire\Auth\ViewQuestions;
use App\Http\Livewire\Auth\CreateQuestion;
use App\Http\Controllers\ProfileController;
use App\Http\Livewire\Course\Coursedetails;
use App\Http\Livewire\Course\Topic\Summary;
use App\Http\Livewire\Auth\StartQuestionBank;
use App\Http\Livewire\Course\Topic\Viewtopic;
use App\Http\Livewire\Course\Topic\Viewsummary;
use App\Http\Livewire\Auth\QuestionBankQuestions;
use App\Http\Livewire\Auth\ViewQuestionAndOptions;
use App\Http\Livewire\Course\Topic\Quiz\Startquiz;
use App\Http\Livewire\Course\Topic\Discussion\View;
use App\Http\Livewire\Course\Topic\Discussion\Create;

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
});

Route::prefix('topic')->name('topic.')->group(function () {
    Route::get('/{topic:key}', Viewtopic::class)->name('topic');
});

Route::prefix('discussion')->group(function(){
    Route::get('/create/{topic:key}', Create::class)
    // ->middleware(['auth'])
    ->name('create-discussion');
    Route::get('/{discussion:key}', View::class)->name('view-discussion');
});

Route::prefix('quiz')->name('quiz.')->group(function () {
    Route::get('/{quiz:key}', Startquiz::class)->name('start');
});

Route::prefix('summary')->group(function(){
    Route::get('/{summary:key}', Viewsummary::class)->name('viewsummary');
});


Route::middleware(['auth'])->prefix('auth')->name('auth.')->group(function () {
    Route::get('/question_bank', QuestionBank::class)->name('question_bank');
    Route::get('/question_bank/{question_bank:key}/questions', QuestionBankQuestions::class)->name('question_bank_questions');
    Route::get('/question_bank/{question_bank:key}/create-question', CreateQuestion::class)->name('create-question');
    Route::get('/question_bank/{question_bank:key}/start-questions', StartQuestionBank::class)->name('start-questions');
    Route::get('/question_bank/{question_bank:key}/view-questions', ViewQuestions::class)->name('viewquestions');
    Route::get('/question/edit-question', EditQuestion::class)->name('editquestion');
    Route::get('/question/view-question', ViewQuestionAndOptions::class)->name('viewquestion');
});

Route::get('/topic/{topic:key}/idea', [IdeaController::class, 'index'])->name('idea.index');
Route::get('/topic/{topic:key}/ideas/{idea:slug}', [IdeaController::class, 'show'])->name('idea.show');

require __DIR__.'/auth.php';
