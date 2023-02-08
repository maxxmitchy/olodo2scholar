<?php

namespace App\Models;

use App\Traits\HasKey;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Summary extends Model
{
    use HasKey;
    use HasFactory;

    protected $fillable = [
        'key',
        'title',
        'body',
    ];

    public function topic()
    {
        return $this->belongsTo(
            related: Topic::class,
            foreignKey: 'topic_id',
        );
    }

    public function quizzes(): HasMany
    {
        return $this->hasMany(Quiz::class);
    }
}
