<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\HasKey;
use Laravel\Sanctum\HasApiTokens;
use App\Jobs\SendVerificationEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasKey, HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'key',
        'sex',
        'first_name',
        'last_name',
        'email',
        'phone',
        'date_of_birth',
        'registeration_number',
        'parent_id',
        'password',
        // 'email_verifieed_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function courses(): HasMany
    {
        return $this->hasMany(
            related: Course::class,
        );
    }

    public function sendEmailVerificationNotification()
    {
        SendVerificationEmail::dispatch($this);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(
            related: Department::class,
        );
    }

    public function level(): BelongsTo
    {
        return $this->belongsTo(
            related: Level::class,
            foreignKey: 'level_id'
        );
    }

    public function university(): BelongsTo
    {
        return $this->belongsTo(
            related: University::class,
        );
    }

    public function question_banks(): BelongsToMany
    {
        return $this->belongsToMany(QuestionBank::class)
                    ->withPivot(['user_score', 'max_score']);
    }
}
