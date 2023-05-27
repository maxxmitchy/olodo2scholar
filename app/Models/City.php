<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\HasKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class City extends Model
{
    use HasFactory;
    use HasKey;

    protected $fillable = [
        'key',
        'name',
        'city_code',
        'state_id',
        'active',
    ];

    protected $cast = [
        'active' => 'boolean',
    ];

    public function state(): BelongsTo
    {
        return $this->belongsTo(
            related: State::class,
            foreignKey: 'state_id',
        );
    }
}
