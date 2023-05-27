<?php

declare(strict_types=1);

namespace App\Http\Livewire\Auth;

use App\Models\Option;
use App\Models\QuestionBank;
use Filament\Notifications\Notification;
use Livewire\Component;

final class CreateQuestion extends Component
{
    public $qbank;

    public $content;

    public $explanation;

    public array $options = ['True', 'False'];

    public int $answer = 0;

    protected $listeners = [
        'questionSaved' => '$refresh',
    ];

    public function mount($question_bank): void
    {
        $this->qbank = $question_bank;
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

    public function getCurrentQuestionBankProperty()
    {
        return QuestionBank::where('key', $this->qbank)->with('questions')->first();
    }

    public function store(): void
    {
        $question = $this->currentquestionbank->questions()->create([
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

        Notification::make()
            ->title('Question created successfully')
            ->success()
            ->body('If you have any troubles please contact us.')
            ->send();
    }

    public function render()
    {
        return view('livewire.auth.create-question');
    }
}
