<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use App\Models\Question;
use App\Models\QuestionBank;
use Filament\Forms\Components\Grid;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Concerns\InteractsWithForms;

class EditQuestion extends Component implements HasForms
{
    use InteractsWithForms;

    public $question;

    public $qbankKey;

    public $content;
    public $explanation;

    public function mount()
    {
        $this->question = Question::find(request()->query('record'));

        $this->qbankKey = QuestionBank::where('id', $this->question->questionable_id)->first()->key;

        $this->form->fill([
            'content' => $this->question->content,
            'explanation' => $this->question->explanation,
        ]);
    }

    protected function getFormSchema(): array
    {
        return [
            Grid::make()
            ->schema([
                Textarea::make('content')
                    ->required(),
                Textarea::make('explanation'),
            ])
        ];
    }

    public function create()
    {
        $this->question->update($this->form->getState());

        return to_route('auth.viewquestions', ['question_bank' => $this->qbankKey]);
    }

    public function render()
    {
        return view('livewire.auth.edit-question');
    }
}