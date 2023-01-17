<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlashcardReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'flashcard_id',
        'user_id',
        'next_review'
    ];

    public function flashcard()
    {
        return $this->belongsTo(Flashcard::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
