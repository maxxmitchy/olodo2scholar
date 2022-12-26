<?php

namespace App\Models;

use App\Traits\HasKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionType extends Model
{
    use HasKey;
    use HasFactory;

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
