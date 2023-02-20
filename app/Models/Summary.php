<?php

namespace App\Models;

use App\Traits\HasKey;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Summary extends Model
{
    use HasKey;
    use HasFactory;

    protected $fillable = [
        'key',
        'title',
        'body',
        'topic_id'
    ];

    public function topic(): BelongsTo
    {
        return $this->belongsTo(
            related: Topic::class,
            foreignKey: 'topic_id',
        );
    }

    public function slides(): HasMany
    {
        return $this->hasMany(Slide::class);
    }
}
