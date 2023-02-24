<?php

namespace App\Http\Livewire\Course\Topic\Discussion;

use Livewire\Component;
use App\Models\Discussion;
use Livewire\WithPagination;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Concerns\InteractsWithForms;

class View extends Component implements HasForms
{
    use InteractsWithForms, WithPagination;

    public $discussion;

    public $attachment;

    public $view_comment = '';

    public $content;

    public $page = 1;

    public $discussionLiked = false;

    public $repliesPage = 1;

    public function mount(Discussion $discussion)
    {
        $this->discussion = $discussion;
    }

    protected $listeners = [
        'liked' => 'isDiscussionLiked',
    ];

    public function isDiscussionLiked()
    {
        $this->discussionLiked = !$this->discussionLiked;
    }

    public function viewReply(string $reply)
    {
        if ($reply == '') {
            $this->resetPage('repliesPage');
        }
        return $this->view_comment = $reply;
    }

    protected $queryString = [
        'view_comment' => ['except' => ''],
    ];

    protected function getFormSchema(): array
    {
        return [
            RichEditor::make('content')
                ->toolbarButtons(['bold', 'bulletList', 'codeBlock', 'italic', 'link', 'orderedList', 'redo', 'strike', 'undo'])
                ->required(),

            FileUpload::make('attachment'),
        ];
    }

    public function addNewComment($parent = null)
    {
        $this->validate();

        if (!auth()->check()) {
            $this->dispatchBrowserEvent('comment-added');

            return Notification::make()
                ->title('please login to make a comment')
                ->danger()
                ->send();
        }

        $this->discussion->comment(parent: $parent ? $parent['id'] : null, content: $this->content, user: auth()->user(), attachment: $this->attachment);

        $this->content = '';

        $this->attachment = '';

        if ($parent) {
            $this->dispatchBrowserEvent('comment-replied', ['key' => $parent['key']]);
        } else {
            $this->dispatchBrowserEvent('comment-added');
        }

        Notification::make()
            ->title('Comment created successfully')
            ->success()
            ->send();
    }

    public function getCommentsProperty()
    {
        return $this->discussion
            ->comments()
            ->latest()
            ->paginate(12);
    }

    public function getCommentRepliesProperty()
    {
        return $this->discussion
            ->comments()
            ->where('key', $this->view_comment)
            ->first();
    }

    public function getCommentRepliesChildrenProperty()
    {
        return $this->comment_replies->children()->paginate(7, ['*'], 'repliesPage');
    }

    public function getRelatedProperty()
    {
        return Discussion::where('id', '<>', $this->discussion->id)
            ->whereHas('topic', function ($query) {
                $query->where('id', '=', $this->discussion->topic_id);
            })
            ->inRandomOrder()
            ->take(6)
            ->get();
    }

    public function likeDiscussion()
    {
        if (!auth()->check()) {
            return Notification::make()
                ->title('please login to like a discussion')
                ->danger()
                ->send();
        }

        if ($this->userLikesDiscussion()) {
            $this->discussion
                ->likes()
                ->where('user_id', auth()->id())
                ->delete();
        } else {
            $this->discussion->likes()->create([
                'user_id' => auth()->id(),
            ]);
        }

        $this->emitSelf('liked');
    }

    public function userLikesDiscussion(): bool
    {
        if (auth()->check()) {
            return $this->discussion
                ->likes()
                ->where('user_id', auth()->id())
                ->exists();
        }

        return false;
    }

    public function render()
    {
        // dd($this->userLikesDiscussion());

        return view('livewire.course.topic.discussion.view')->layout('layouts.guest');
    }
}
