<?php

namespace App\Models;

use App\Traits\HasKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Question extends Model
{
    use HasKey;
    use HasFactory;

    protected $fillable = [
        'content',
        'explanation',
        'questionable_id',
        'questionable_type',
        'question_type_id',
    ];

    public function questionable()
    {
        return $this->morphTo();
    }

    public function questionType(): BelongsTo
    {
        return $this->belongsTo(
            related: QuestionType::class,
            foreignKey: 'question_type_id',
        );
    }

    public function options(): HasMany
    {
        return $this->hasMany(
            related: Option::class,
        );
    }

    public function bookmarks(): MorphMany
    {
        return $this->morphMany(Bookmark::class, 'bookmarkable');
    }
}
