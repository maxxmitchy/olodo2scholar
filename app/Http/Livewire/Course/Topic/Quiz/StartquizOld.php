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

    public function mount($topic, $quiz)
    {
        $this->topic = $topic;

        $this->quiz = $quiz;
    }

    public function getCurrentQuizProperty()
    {
        return Quiz::where('key', $this->quiz)->with(
            'questions',
            'questions.options',
        )->first();
    }

    public function getCurrentTopicProperty()
    {
        return Topic::where('key', $this->topic)->first();
    }

    public function submitQuiz($answers)
    {
        // json_decode($answers, true);
    }

    public function render()
    {
        if (is_null($this->currenttopic)) {
            abort(404);
        }

        return view('livewire.course.topic.quiz.startquiz')->layout('layouts.guest');
    }
}
