<?php

declare(strict_types=1);

namespace App\Models;

use App\Scopes\HasActiveScope;
use App\Traits\HasKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

final class Quiz extends Model
{
    use HasFactory;
    use HasKey;

    protected $fillable = [
        'name',
        'difficulty_id',
        'topic_id',
        'active',
    ];

    protected $with = ['difficulty', 'questions', 'questions.options', 'bookmarks'];

    public function difficulty(): BelongsTo
    {
        return $this->belongsTo(Difficulty::class, 'difficulty_id');
    }

    public function topic(): BelongsTo
    {
        return $this->belongsTo(Topic::class, 'topic_id');
    }

    public function summary(): BelongsTo
    {
        return $this->belongsTo(Topic::class, 'topic_id');
    }

    public function questions(): MorphMany
    {
        return $this->morphMany(
            related: Question::class,
            name: 'questionable'
        );
    }

    protected static function booted(): void
    {
        static::addGlobalScope(new HasActiveScope());
    }

    public function bookmarks(): MorphMany
    {
        return $this->morphMany(Bookmark::class, 'bookmarkable');
    }
}
