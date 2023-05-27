<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\HasKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

final class University extends Model
{
    use HasFactory;
    use HasKey;

    protected $fillable = [
        'key',
        'name',
        'description',
        'location_id',
        'active',
    ];

    public function faculties(): BelongsToMany
    {
        return $this->belongsToMany(
            related: Faculty::class,
            table: 'faculty_university',
        );
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
