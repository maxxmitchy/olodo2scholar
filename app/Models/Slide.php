<?php

namespace App\Models;

use App\Traits\HasKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    use HasFactory;
    use HasKey;

    protected $fillable = [
        'key',
        'title',
        'body',
        'image',
        'type',
    ];

    public function summary()
    {
        return $this->belongsTo(Summary::class);
    }
}
