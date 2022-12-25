<?php

namespace App\Http\Livewire\Course\Topic;

use App\Models\Topic;
use Livewire\Component;

class Viewtopic extends Component
{
    public $topic;

    public function mount($topic)
    {
        $this->topic = $topic;
    }

    public function getTopicQuizzesProperty()
    {
        return Topic::where('key', $this->topic)->first(['id', 'title', 'course_id']);
    }

    public function render()
    {
        return view('livewire.course.topic.viewtopic')->layout('layouts.guest');
    }
}
