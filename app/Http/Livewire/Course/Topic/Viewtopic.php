<?php

namespace App\Http\Livewire\Course\Topic;

use App\Models\Course;
use App\Models\Topic;
use Livewire\Component;

class Viewtopic extends Component
{
    public $topic;

    public $coursetopic;

    public $course;

    public $topicId;

    public function mount($topic)
    {
        $this->topic = $topic;
        $this->coursetopic = Topic::where('key', $this->topic)->first(['id', 'key', 'title', 'body', 'overview', 'course_id']);
        $this->course = Course::where('id', $this->coursetopic->course_id)->first();
        $this->topicId = $this->coursetopic->id;
    }

    public function render()
    {
        return view('livewire.course.topic.viewtopic')->layout('layouts.guest');
    }
}
