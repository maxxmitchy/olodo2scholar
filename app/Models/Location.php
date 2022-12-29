<?php

namespace App\Models;

use App\Traits\HasKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasKey;
    use HasFactory;

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
