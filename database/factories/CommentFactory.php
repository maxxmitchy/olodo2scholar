<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Discussion;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
final class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Comment::class;

    public function definition()
    {
        return [
            'user_id' => User::random(),
            'status_id' => 1,
            'content' => $this->faker->paragraph(5),
            'commentable_type' => 'App/Models/Discussion',
            'commentable_id' => Discussion::randoms(),
        ];
    }
}
