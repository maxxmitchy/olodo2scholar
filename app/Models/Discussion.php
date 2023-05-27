<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\HasComments;
use App\Traits\HasKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

final class Discussion extends Model
{
    use HasComments;
    use HasFactory;
    use HasKey;

    protected $fillable = [
        'user_id',
        'topic_id',
        'title',
        'body',
        'tags',
        'is_question',
    ];

    protected $cast = [
        'tags' => 'json',
        'is_question' => 'boolean',
    ];

    public function likes()
    {
        return $this->morphMany('App\Models\Like', 'likeable');
    }

    public function topic(): BelongsTo
    {
        return $this->belongsTo(Topic::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bookmarks(): MorphMany
    {
        return $this->morphMany(Bookmark::class, 'bookmarkable');
    }
}
