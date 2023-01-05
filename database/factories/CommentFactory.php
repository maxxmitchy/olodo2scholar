<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Idea;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
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
            'user_id' => $this->faker->numberBetween(1, 5),
            'status_id' => 1,
            'content' => $this->faker->paragraph(5),
        ];
    }

    public function configure()
    {
        return $this->for(
            static::factoryForModel(
                $this->commentable()),
            'commentable'
        );
    }

    public function existing()
    {
        return $this->state(function (array $attributes) {
            return [
                'user_id' => $this->faker->numberBetween(1, 5),
                'status_id' => 1,
            ];
        });
    }

    public function commentable()
    {
        return $this->faker->randomElement([
            Idea::class,
        ]);
    }
}
