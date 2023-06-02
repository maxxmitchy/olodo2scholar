<?php

namespace App\Models;

use App\Traits\HasKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Annotation extends Model
{
    use HasKey;
    use HasFactory;

    protected $fillable = [
        'key',
        'body',
        'user_id',
        'slide_id',
    ];

    protected $with = ['user']; 

    public function slide()
    {
        return $this->belongsTo(Slide::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
