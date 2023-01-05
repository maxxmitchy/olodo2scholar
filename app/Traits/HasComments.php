<?php

namespace App\Traits;

use app\Interfaces\IsComment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Auth;

trait HasComments
{
    public function comments(): MorphMany
    {
        return $this->morphMany(config('comments.model'), 'commentable');
    }

    public function comment(string $content, Model $user = null, IsComment $parent = null, int $status = 1, bool $isStatusUpdate = false)
    {
        return $this->comments()->create([
            'content' => $content,
            'status_id' => $status,
            'user_id' => $user ? $user->getKey() : Auth::id(),
            'parent_id' => $parent?->getKey(),
            'is_status_update' => $isStatusUpdate,
        ]);
    }
}
