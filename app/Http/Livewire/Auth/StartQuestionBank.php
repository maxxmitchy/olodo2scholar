<?php

namespace App\Http\Livewire\Auth;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\QuestionBank;

class StartQuestionBank extends Component
{
    public $currentquestionbank;
    public $time = 1;

    protected $listeners = ['timeElapsed' => 'timeElapsed'];

    public $minutes;
    public $seconds;

    public function mount($question_bank)
    {
        // $date = Carbon::parse('2023-01-04 13:16:30');

        // $minutes = $date->diffInMinutes(Carbon::now());

        $this->minutes = floor($this->time);

        $this->seconds = ($this->time - $this->minutes) * 60;

        $this->emit('entangle', ['minutes' => $this->minutes, 'seconds' => $this->seconds]);

        $this->currentquestionbank = QuestionBank::where('key', $question_bank)->with(
            'questions',
            'questions.options',
        )->first();
    }

    public function timeElapsed($data)
    {
        dd($data['answers']);
    }

    public function render()
    {
        return view('livewire.auth.start-question-bank')->layout('layouts.guest');;
    }
}

