<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class Difficulty extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }
}
