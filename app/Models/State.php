<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\HasKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class State extends Model
{
    use HasFactory;
    use HasKey;

    protected $fillable = [
        'key',
        'name',
        'state_code',
        'active',
    ];

    protected $cast = [
        'active' => 'boolean',
    ];

    public function cities(): HasMany
    {
        return $this->hasMany(
            related: City::class,
            foreignKey: 'city_id',
        );
    }
}
