<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Idea;
use App\Models\Level;
use App\Models\Course;
use App\Traits\HasKey;
use App\Models\Comment;
use App\Models\Department;
use App\Models\University;
use App\Models\QuestionBank;
use Laravel\Sanctum\HasApiTokens;
use App\Jobs\SendVerificationEmail;
use Filament\Models\Contracts\HasName;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable implements FilamentUser, HasName
{
    use HasKey, HasApiTokens, HasFactory, Notifiable, SoftDeletes;

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

    public function takencourses()
    {
        return $this->belongsToMany(Course::class);
        // ->withPivot(["user_score", "max_score"]);
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

    public function ideas()
    {
        return $this->hasMany(Idea::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function votes()
    {
        return $this->belongsToMany(Idea::class, 'votes');
    }

    public function getAvatar()
    {
        $firstCharacter = $this->email[0];

        $integerToUse = is_numeric($firstCharacter)
            ? ord(strtolower($firstCharacter)) - 21
            : ord(strtolower($firstCharacter)) - 96;

        return 'https://www.gravatar.com/avatar/'
            .md5($this->email)
            .'?s=200'
            .'&d=https://s3.amazonaws.com/laracasts/images/forum/avatars/default-avatar-'
            .$integerToUse
            .'.png';
    }

    public function isAdmin()
    {
        return in_array($this->email, [
            'mitchycarl6@gmail.com',
            'schulist.alden@example.net'
        ]);
    }

    public function canAccessFilament(): bool
    {
        return $this->email === "dana@yopmail.com";
    }

    public function getFilamentName(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
