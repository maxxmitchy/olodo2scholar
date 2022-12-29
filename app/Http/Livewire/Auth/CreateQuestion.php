<?php

namespace App\Http\Livewire\Auth;

use App\Models\Option;
use App\Models\Quiz;
use Livewire\Component;

class CreateQuestion extends Component
{
    public $quiz;

    public $content;

    public $explanation;

    public array $options = ['True', 'False'];

    public int $answer = 0;

    protected $listeners = [
        'questionSaved' => '$refresh',
    ];

    public function mount($quiz)
    {
        $this->quiz = $quiz;
    }

    public function rules()
    {
        return [
            'content' => ['required'],
            'explanation' => ['required'],
            'options' => ['required'],
            'answer' => ['required'],
        ];
    }

    public function getCurrentQuizProperty()
    {
        return Quiz::where('key', $this->quiz)->with('questions')->first();
    }

    public function store()
    {
        $question = $this->currentquiz->questions()->create([
            'content' => $this->content,
            'explanation' => $this->explanation,
            'question_type_id' => 1,
        ]);

        foreach ($this->options as $key => $option) {
            Option::create([
                'body' => $option,
                'question_id' => $question->id,
                'correct_option' => (int) $key === $this->answer ? $this->answer : 0,
            ]);
        }

        $this->emitSelf('questionSaved');

        $this->reset(['content', 'explanation', 'answer', 'options']);

        $this->notify('question saved successfully');
    }

    public function render()
    {
        return view('livewire.auth.create-question');
    }
}
