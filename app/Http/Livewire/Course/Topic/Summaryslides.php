<?php

namespace App\Http\Livewire\Course\Topic;

use App\Models\Summary;

use Livewire\Component;

class Summaryslides extends Component
{
    public $summary;

    public $current_slide = 0;

    protected $queryString = [
        'current_slide' => ['except' => 0]
    ];

    public function mount($summary)
    {
        $this->summary = Summary::where('key', $summary)
            ->with(['slides' => function ($query) {
                $query->select('summary_id', 'id', 'key', 'title', 'body', 'type', 'image');
            }])
            ->firstOrFail();
        
        ($this->current_slide > $this->slides->count()) ? $this->current_slide = 0 : true;
    }

    public function getSlidesProperty()
    {
        return $this->summary->slides;
    }

    public function getSummariesProperty()
    {
        return Summary::inRandomOrder()
                    ->where('topic_id', $this->summary->topic_id)
                    ->where('id', '<>', $this->summary->id)
                    ->take(4)
                    ->get();
    }

    public function render()
    {
        return view('livewire.course.topic.summaryslides')->layout('layouts.guest');
    }
}
