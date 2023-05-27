<?php

namespace App\Http\Livewire\Course\Topic\Quiz;

use App\Models\Quiz;
use Livewire\Component;

class Startquiz extends Component
{
    public $topic;

    public $quiz;

    public $answers = [];

    public function mount(Quiz $quiz)
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
}
