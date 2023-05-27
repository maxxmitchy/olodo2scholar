<?php

declare(strict_types=1);

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Auth;

trait HasComments
{
    public function comments(): MorphMany
    {
        return $this->morphMany(config('comments.model'), 'commentable');
    }

    public function comment(string $content, ?Model $user = null, $parent = null, ?string $attachment = null)
    {
        return $this->comments()->create([
            'content' => $content,
            'attachment' => $attachment,
            'user_id' => $user ? $user->getKey() : Auth::id(),
            'parent_id' => $parent,
        ]);
    }
}
