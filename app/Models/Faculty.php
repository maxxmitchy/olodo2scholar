<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\HasKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

final class Faculty extends Model
{
    use HasFactory;
    use HasKey;

    protected $fillable = [
        'key',
        'name',
        'description',
        'active',
    ];

    public function universities(): BelongsToMany
    {
        return $this->belongsToMany(
            related: University::class,
            table: 'faculty_university',
        );
    }

    public function departments()
    {
        return $this->hasMany(Department::class);
    }
}
