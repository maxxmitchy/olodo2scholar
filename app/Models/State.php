<?php

namespace App\Models;

use App\Traits\HasKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class State extends Model
{
    use HasKey;
    use HasFactory;

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
