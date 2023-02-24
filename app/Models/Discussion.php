<?php

namespace App\Models;

use App\Models\User;
use App\Models\Vote;
use App\Models\Topic;
use App\Traits\HasKey;
use App\Traits\HasComments;
use Illuminate\Database\Eloquent\Model;
use App\Exceptions\VoteNotFoundException;
use App\Exceptions\DuplicateVoteException;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Discussion extends Model
{
    use HasKey;
    use HasFactory;
    use HasComments;

    protected $fillable = [
        'user_id',
        'topic_id',
        'title',
        'body',
        'tags',
        'is_question',
    ];

    protected $cast = [
        'tags' => 'json',
        'is_question' => 'boolean'
    ];


    public function likes()
    {
        return $this->morphMany('App\Models\Like', 'likeable');
    }

    
    public function topic(): BelongsTo
    {
        return $this->belongsTo(Topic::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
