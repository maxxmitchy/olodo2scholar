<?php

namespace App\Models;

use app\Enum\CourseStatusEnum;
use App\Traits\HasKey;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Course extends Model
{
    use HasKey;
    use HasFactory;

    protected $casts = [
        'status' => CourseStatusEnum::class
    ];

    protected $fillable = [
        'key',
        'title',
        'code',
        'status',
        'description',
        'level_id',
        'user_id',
        'department_id',
    ];

    protected $with = [
        'user',
        'level:id,name',
        'department:id,name',
        'topics:id,key,title,body,updated_at,course_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(
            related: User::class,
        );
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(
            related: User::class,
        );
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(
            related: Department::class
        );
    }

    public function level(): BelongsTo
    {
        return $this->belongsTo(
            related: Level::class,
        );
    }

    public function topics()
    {
        return $this->hasMany(
            related: Topic::class,
        );
    }

    public function summaries()
    {
        return $this->hasManyThrough(
            Summary::class,
            Topic::class,
            'topic_id', // Foreign key on the topics table...
            'summary_id', // Foreign key on the summaries table...
            'id', // Local key on the courses table...
            'id' // Local key on the topics table...
        );
    }
}
