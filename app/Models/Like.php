<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class Like extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function likeable()
    {
        return $this->morphTo();
    }
}
