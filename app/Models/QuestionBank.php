<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\HasKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

final class QuestionBank extends Model
{
    use HasFactory;
    use HasKey;

    protected $fillable = [
        'key',
        'title',
        'description',
        'user_id',
    ];

    public function questions(): MorphMany
    {
        return $this->morphMany(
            related: Question::class,
            name: 'questionable'
        );
    }
}
