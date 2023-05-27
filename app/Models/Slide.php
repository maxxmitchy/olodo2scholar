<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\HasKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

final class Slide extends Model
{
    use HasFactory;
    use HasKey;

    protected $fillable = [
        'key',
        'title',
        'body',
        'image',
        'type',
    ];

    public function summary()
    {
        return $this->belongsTo(Summary::class);
    }

    public function bookmarks(): MorphMany
    {
        return $this->morphMany(Bookmark::class, 'bookmarkable');
    }
}
