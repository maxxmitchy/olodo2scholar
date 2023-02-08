<?php

namespace App\Http\Livewire\Course\Topic;

use App\Models\Summary as ModelsSummary;
use App\Models\Topic;
use Livewire\Component;

class Summary extends Component
{
    public $summaries;

    public $topic;

    public function mount($topic)
    {
        $this->topic = Topic::where('key', $topic)->first(['id', 'key', 'title']);

        $this->summaries = ModelsSummary::where('topic_id', $this->topic->id)->get();
    }

    public function render()
    {
        return view('livewire.course.topic.summary')->layout('layouts.guest');
    }
}
