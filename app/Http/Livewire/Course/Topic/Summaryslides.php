<?php

namespace App\Http\Livewire\Course\Topic;

use App\Models\Slide;
use App\Models\Summary;
use Livewire\Component;

class Summaryslides extends Component
{
    public $summary;

    public $start_slide = 0;

    protected $queryString = [
        'start_slide' => ['except' => 0],
    ];

    public function mount($summary)
    {
        $this->summary = Summary::where('key', $summary)
            ->with([
                'slides' => function ($query) {
                    $query->select('summary_id', 'id', 'key', 'title', 'body', 'type', 'image');
                },
            ])
            ->firstOrFail();

        $this->start_slide > $this->slides->count() ? ($this->start_slide = 0) : true;
    }

    public function getSlidesProperty()
    {
        return $this->summary->slides()->with(['bookmarks' => function ($query) {
            $query->where('user_id', auth()->user()?->id);
        }])->get();
    }

    public function getSummariesProperty()
    {
        return Summary::inRandomOrder()
            ->where('topic_id', $this->summary->topic_id)
            ->where('id', '<>', $this->summary->id)
            ->take(4)
            ->get();
    }

    public function toggleBookmark(Slide $slide)
    {
        if (! auth()->check()) {
            return;
        }
        $bookmarked_slide = $slide->bookmarks()->where('user_id', auth()->user()->id)->first();

        if ($bookmarked_slide) {
            $bookmarked_slide->delete();
        } else {
            $slide->bookmarks()->create([
                'user_id' => auth()->user()->id,
            ]);
        }

        return ['slides' => $this->slides];
    }

    public function render()
    {
        return view('livewire.course.topic.summaryslides')->layout('layouts.guest');
    }
}
