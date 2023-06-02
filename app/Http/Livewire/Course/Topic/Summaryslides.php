<?php

declare(strict_types=1);

namespace App\Http\Livewire\Course\Topic;

use App\Models\Annotation;
use App\Models\Slide;
use App\Models\Summary;
use Livewire\Component;

final class Summaryslides extends Component
{
    public $summary;

    public $start_slide = 0;

    public $cursor;

    public $annotations;

    public $body;

    protected $queryString = [
        'start_slide' => ['except' => 0],
    ];

    public function mount($summary): void
    {
        $this->summary = Summary::where('key', $summary)
            ->with([
                'slides' => function ($query): void {
                    $query->select('summary_id', 'id', 'key', 'title', 'body', 'type', 'image');
                }
            ])
            ->firstOrFail();

        $this->start_slide > $this->slides->count() ? ($this->start_slide = 0) : true;
    }

    public function getSlidesProperty()
    {
        return $this->summary
            ->slides()
            ->with([
                'bookmarks' => function ($query): void {
                    $query->where('user_id', auth()->user()?->id);
                },
            ])
            ->withCount('annotations')
            ->get();
    }

    public function loadAnnotations(Slide $slide, $cursor = 0)
    {
        $annotations = $slide->annotations()
                            ->with(['votes' => function($query){
                                $query->where('user_id', auth()->id());
                            }])
                            ->withCount('votes')
                            ->orderBy('votes_count', 'DESC')
                            ->limit(12)
                            ->offset($cursor)
                            ->get();

        return ['annotations' => $annotations];
    }

    public function getSummariesProperty()
    {
        return Summary::inRandomOrder()
            ->where('topic_id', $this->summary->topic_id)
            ->where('id', '<>', $this->summary->id)
            ->take(4)
            ->get();
    }

    public function createAnnotation(Slide $slide, $body)
    {
        if (auth()->check()) {
            $annotation = $slide->annotations()->create([
                'body' => $body,
                'user_id' => auth()->id(),
            ]);
            return ['annotation' => $this->formatAnnotation($annotation->id)];
        } else {
            return new \Exception("Error Processing Request", 1);  
        }
    }

    public function toggleAnnotationVote(Annotation $annotation)
    {
        $userHasVoted = $annotation->votes()->whereHas('user', function ($query) {
            $query->where('id', auth()->id());
        })->exists();

        if ($userHasVoted) {
            $annotation->votes()->where(
                'user_id' , auth()->id()
            )->delete();          
        } else {
            $annotation->votes()->create([
                'user_id' => auth()->id(),
            ]);
        }
        return [
                'annotation' => $this->formatAnnotation($annotation->id),
            ];
    }

    public function updateAnnotationCount($slide)
    {
        $data = Slide::where('id', $slide)->withCount('annotations')->first();

        return ['slide' => $data];
    }

    private function formatAnnotation($id)
    {
        return Annotation::where('id', $id)->with(['votes' => function($query){
                    $query->where('user_id', auth()->id());
                }])->withCount('votes')->first();
    }

    public function toggleBookmark(Slide $slide)
    {
        if (!auth()->check()) {
            return;
        }

        $bookmarked_slide = $slide
            ->bookmarks()
            ->where('user_id', auth()->user()->id)
            ->first();

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
