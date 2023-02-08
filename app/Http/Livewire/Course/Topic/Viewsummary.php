<?php

namespace App\Http\Livewire\Course\Topic;

use App\Models\Topic;
use App\Models\Course;
use App\Models\Summary;
use Livewire\Component;

class Viewsummary extends Component
{
    public $summary;

    public $topic;

    public $course;

    public function mount(Summary $summary, Topic $topic)
    {
        $this->course = Course::where('id', $topic->course_id)->first(['id', 'key']);

        $this->topic = $topic;

        $this->summary = $summary;
    }

    public function render()
    {
        return view('livewire.course.topic.viewsummary')->layout('layouts.guest');
    }
}
