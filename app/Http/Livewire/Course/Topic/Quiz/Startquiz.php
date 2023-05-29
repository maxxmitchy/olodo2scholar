<?php

declare(strict_types=1);

namespace App\Http\Livewire\Course\Topic\Quiz;

use App\Models\Quiz;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Livewire\Component;

final class Startquiz extends Component implements HasForms
{
    use InteractsWithForms;

    public $topic;

    public $quiz;

    public $exam_mode;

    public $answers = [];

    protected $queryString = [
        'exam_mode' => ['except' => '']
    ];

    public function mount(Quiz $quiz): void
    {
        $this->quiz = $quiz;
    }

    public function submitQuiz($data)
    {
        return redirect()->route('quiz-result')->with(['data' => $data]);
    }

    public function render()
    {
        return view('livewire.course.topic.quiz.startquiz')->layout('layouts.guest');
    }

    protected function getFormSchema(): array
    {
        return [
            Toggle::make('exam_mode')->reactive()->required()
        ];
    }
}
