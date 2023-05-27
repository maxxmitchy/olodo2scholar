<?php

namespace App\Models;

use App\Traits\HasKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Topic extends Model
{
    use HasKey;
    use HasFactory;

    protected $fillable = [
        'key',
        'title',
        'body',
        'course_id',
        'overview',
    ];

    protected $with = [
        'quizzes',
        'summaries',
    ];

    public function discussions()
    {
        return $this->hasMany(Discussion::class);
    }

    public function course()
    {
        return $this->belongsTo(
            related: Course::class,
            foreignKey: 'course_id',
        );
    }

    public function quizzes(): HasMany
    {
        return $this->hasMany(Quiz::class);
    }

    public function flashcards(): HasMany
    {
        return $this->hasMany(Flashcard::class);
    }

    public function summaries()
    {
        return $this->hasMany(
            related: Summary::class,
        );
    }

    public function ideas()
    {
        return $this->hasMany(
            related: Idea::class,
        );
    }
}
