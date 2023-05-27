<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\HasKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class Location extends Model
{
    use HasFactory;
    use HasKey;

    protected $fillable = [
        'key',
        'country',
        'name',
        'addressLine1',
        'addressLine2',
        'city_id',
    ];

    public function university()
    {
        return $this->belongsTo(
            related: University::class,
        );
    }
}
