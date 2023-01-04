<?php

namespace App\Http\Livewire\Course\Topic;

use App\Models\Topic;
use App\Models\Course;
use Livewire\Component;

class Viewtopic extends Component
{
    public $topic;

    public function mount($topic)
    {
        $this->topic = $topic;
    }

    public function getCourseTopicProperty()
    {
        return Topic::where('key', $this->topic)->first(['id', 'key', 'title', 'body', 'overview', 'course_id']);
    }

    public function getCourseProperty()
    {
        return Course::where('id', $this->coursetopic->course_id)->first();
    }

    public function render()
    {
        return view('livewire.course.topic.viewtopic')->layout('layouts.guest');
    }
}
