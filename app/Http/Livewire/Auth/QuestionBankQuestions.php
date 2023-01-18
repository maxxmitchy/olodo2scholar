<?php

namespace App\Http\Livewire\Auth;

use App\Models\QuestionBank;
use Livewire\Component;

class QuestionBankQuestions extends Component
{
    public $questionBankKey;

    public $question_bank;

    public function mount(QuestionBank $question_bank)
    {
        $this->question_bank = $question_bank;
        $this->questionBankKey = $question_bank->key;
    }

    public function render()
    {
        return view('livewire.auth.question-bank-questions');
    }
}
