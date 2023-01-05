<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Idea;
use App\Models\Status;
use App\Models\Topic;
use App\Models\Vote;
use App\Traits\WithAuthRedirects;
use Livewire\Component;
use Livewire\WithPagination;

class IdeasIndex extends Component
{
    use WithPagination, WithAuthRedirects;

    public $status;

    public $category;

    public $filter;

    public $search;

    public $topicId;

    public $statuses;

    public $categories;

    protected $queryString = [
        'status',
        'category',
        'filter',
        'search',
    ];

    protected $listeners = ['queryStringUpdatedStatus'];

    public function mount()
    {
        $this->topicId = Topic::where('key', request()->topic->key)->first()->id;
        $this->statuses = Status::all()->pluck('id', 'name');
        $this->categories = Category::all();

        $this->status = request()->status ?? 'All';
    }

    public function updatingCategory()
    {
        $this->resetPage();
    }

    public function updatingFilter()
    {
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatedFilter()
    {
        if ($this->filter === 'My Ideas') {
            if (auth()->guest()) {
                return $this->redirectToLogin();
            }
        }
    }

    public function queryStringUpdatedStatus($newStatus)
    {
        $this->resetPage();
        $this->status = $newStatus;
    }

    public function render()
    {
        $query = Idea::where('topic_id', $this->topicId)->with('user', 'category', 'status')
            ->addSelect(['voted_by_user' => Vote::select('id')
                ->where('user_id', auth()->id())
                ->whereColumn('idea_id', 'ideas.id'),
            ])
            ->withCount('votes')
            ->withCount('comments')
            ->orderBy('id', 'desc');

        if ($this->status && $this->status !== 'All') {
            $query->where('status_id', $this->statuses->get($this->status));
        }

        if ($this->category && $this->category !== 'All Categories') {
            $query->where('category_id', $this->categories->pluck('id', 'name')->get($this->category));
        }

        if ($this->filter && $this->filter === 'Top Voted') {
            $query->orderByDesc('votes_count');
        }

        if ($this->filter && $this->filter === 'My Ideas') {
            $query->where('user_id', auth()->id());
        }

        if ($this->filter && $this->filter === 'Spam Ideas') {
            $query->where('spam_reports', '>', 0)->orderByDesc('spam_reports');
        }

        if ($this->filter && $this->filter === 'Spam Comments') {
            $query->whereHas('comments', function ($query) {
                $query->where('spam_reports', '>', 0);
            });
        }

        if (strlen($this->search) >= 3) {
            $query->where('title', 'like', '%'.$this->search.'%');
        }

        return view('livewire.ideas-index', [
            'ideas' => $query->simplePaginate()->withQueryString(),
            'categories' => $this->categories,
        ]);
    }
}
