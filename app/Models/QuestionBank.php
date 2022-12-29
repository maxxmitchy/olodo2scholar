<?php

namespace App\Models;

use App\Traits\HasKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class QuestionBank extends Model
{
    use HasKey;
    use HasFactory;

    protected $fillable = [
        'key',
        'title',
        'user_id',
    ];

    public function questions(): MorphMany
    {
        return $this->morphMany(
            related: Question::class,
            name: 'questionable');
    }
}
