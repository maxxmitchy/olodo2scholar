<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flashcard extends Model
{
    use HasFactory;

    protected $fillable = [
        'concept',
        'definition',
        'image',
        'topic_id',
    ];

    public function reviews()
    {
        return $this->hasMany(FlashcardReview::class);
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }
}
