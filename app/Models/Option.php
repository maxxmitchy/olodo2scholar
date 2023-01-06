<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Option extends Model
{
    use HasFactory;

    protected $fillable = [
        'body',
        'correct_option',
        'active',
        'question_id',
        'explanation',
    ];

    protected $casts = [
        'correct_option' => 'boolean',
    ];

    public function question(): BelongsTo
    {
        return $this->belongsTo(
            related: Question::class,
        );
    }
}
