<?php

declare(strict_types=1);

namespace App\Http\Livewire\Course\Topic;

use App\Models\Category;
use App\Models\Topic;
use Livewire\Component;
use Livewire\WithPagination;

final class Viewtopic extends Component
{
    use WithPagination;

    public $category;

    public $topic;

    public $discussion_title;

    public $discussion_body;

    public $coursetopic;

    public $sort_quiz_search = '';

    public $sort_quiz_difficulty = '';

    public $sort_summary_search = '';

    public $sort_summary_time = '';

    public $quiz_search = '';

    public $discussion_search = '';

    public $course;

    public $activeTab = 'Summaries';

    protected $queryString = [
        'activeTab' => ['as' => 'navTab'],
        'sort_quiz_search' => ['except' => ''],
        'sort_quiz_difficulty' => ['except' => ''],
    ];

    public function mount(Topic $topic): void
    {
        $this->topic = $topic;
    }

    public function getQuizzesProperty()
    {
        return $this->topic->quizzes()->when($this->sort_quiz_search, function ($query, $search): void {
            $query->where('name', 'like', '%' . $search . '%');
        })->when($this->sort_quiz_difficulty, function ($query, $difficulty): void {
            $query->whereRelation('difficulty', 'id', $difficulty);
        })->paginate(12);
    }

    public function getSummariesProperty()
    {
        $result = $this->topic->summaries()->when($this->sort_summary_search, function ($query, $search): void {
            $query->where('title', 'like', '%' . $search . '%');
        })->paginate(12);

        return $result;
    }

    public function sortDisussion()
    {
        return true;
    }

    public function render()
    {
        $categories = Category::all();

        return view('livewire.course.topic.viewtopic', [
            'categories' => $categories,
        ])->layout('layouts.guest');
    }
}
