<?php

namespace App\Models;

use App\Traits\HasKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    use HasKey;
    use HasFactory;

    protected $fillable = [
        'key',
        'name',
        'abbreviation',
        'faculty_id',
    ];

    public function courses(): HasMany
    {
        return $this->hasMany(
            related: Course::class
        );
    }

    public function faculty()
    {
        return $this->belongsTo(
            related: Faculty::class
        );
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
