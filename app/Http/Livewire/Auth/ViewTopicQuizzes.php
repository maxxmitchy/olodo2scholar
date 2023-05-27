<?php

declare(strict_types=1);

namespace App\Http\Livewire\Auth;

use App\Models\Topic;
use Livewire\Component;

final class ViewTopicQuizzes extends Component
{
    public $topic;

    public function mount($topic): void
    {
        $this->topic = $topic;
    }

    public function getTopicQuizzesProperty()
    {
        return Topic::where('key', $this->topic)->first();
    }

    public function render()
    {
        return view('livewire.auth.view-topic-quizzes');
    }
}
