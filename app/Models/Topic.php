<?php

namespace App\Models;

use App\Models\Idea;
use App\Traits\HasKey;
use App\Traits\HasComments;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Topic extends Model
{
    use HasKey;
    use HasFactory;
    use HasComments;

    protected $fillable = [
        'key',
        'title',
        'body',
        'course_id',
        'overview',
    ];

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
