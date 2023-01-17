<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use App\Models\QuestionBank as ModelsQuestionBank;
use Filament\Notifications\Notification;

class QuestionBank extends Component
{
    public $title;
    public $description;

    public $questionBanks;

    protected $rules = [
        'title' => 'required',
        'description' => 'required',
    ];

    public function mount()
    {
        $this->questionBanks = ModelsQuestionBank::where('user_id', auth()->id())->get();
    }

    public function create()
    {
        ModelsQuestionBank::create([
            'title' => $this->title,
            'description' => $this->description,
            'user_id' => auth()->id(),
        ]);

        Notification::make()
        ->title('Q-Bank created successfully')
        ->success()
        ->send();

        return to_route('auth.question_bank');
    }

    public function render()
    {
        return view('livewire.auth.question-bank');
    }
}
