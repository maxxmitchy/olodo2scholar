<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\HasKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class Bookmark extends Model
{
    use HasFactory;
    use HasKey;

    protected $fillable = [
        'user_id',
        'bookmarkable_id',
        'bookmarkable_type',
    ];

    public function bookmarkable()
    {
        return $this->morphTo();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(config('comments.user'), 'user_id');
    }
}
