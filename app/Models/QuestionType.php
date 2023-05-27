<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\HasKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class QuestionType extends Model
{
    use HasFactory;
    use HasKey;

    protected $fillable = [
        'key',
        'name',
        'active',
    ];

    public function questions()
    {
        return $this->hasMany(
            related: Question::class
        );
    }
}
