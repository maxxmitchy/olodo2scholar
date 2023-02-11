<?php

namespace App\Http\Livewire\Course\Topic\Quiz;

use App\Models\Quiz;
use App\Models\Topic;
use Livewire\Component;

class Startquiz extends Component
{
    public $topic;

    public $quiz;

    public $answers = [];

    public $currentquiz;

    public $currenttopic;

    public function mount($topic, $quiz)
    {
        $this->topic = $topic;
        $this->quiz = $quiz;
        $this->currentquiz = Quiz::where('key', $this->quiz)->with(
            'questions',
            'questions.options',
        )->first();
        $this->currenttopic = Topic::where('key', $this->topic)->first();
    }

    public function submitQuiz($data)
    {
        return redirect()->route('quiz-result')->with(['data' => $data]);
    }

    public function render()
    {
        if (is_null($this->currenttopic)) {
            abort(404);
        }

        return view('livewire.course.topic.quiz.startquiz')->layout('layouts.guest');
    }
}
