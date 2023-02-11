<?php

namespace App\Http\Livewire\Course\Topic;

use App\Models\Course;
use App\Models\Topic;
use Livewire\Component;
use App\Models\Summary as ModelsSummary;
use Livewire\WithPagination;

class Viewtopic extends Component
{
    use WithPagination;

    public $topic;

    public $coursetopic;

    public $course;

    public $topicId = '';

    public $activeTab = 'Summaries';

    protected $queryString = [
        'activeTab' => ['as' => 'navTab'],
    ];

    public function mount($topic)
    {
        $this->topic = $topic;
        $this->coursetopic = Topic::where('key', $this->topic)->with('summaries','quizzes')
                        ->first(['id', 'key', 'title', 'body', 'overview', 'course_id']);

        $this->course = Course::where('id', $this->coursetopic->course_id)->first();

        $this->topicId = $this->coursetopic->id;
    }

    public function render()
    {
        return view('livewire.course.topic.viewtopic', [
            'summaries' => ModelsSummary::where('topic_id', $this->coursetopic->id)->paginate(6)
        ])->layout('layouts.guest');
    }
}
