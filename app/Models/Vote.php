<?php

namespace App\Models;

use App\Traits\HasKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasKey;
    use HasFactory;

    protected $fillable = [
        'key',
        'user_id',
        'annotation_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function annotation()
    {
        return $this->belongsTo(Annotation::class);
    }
}
