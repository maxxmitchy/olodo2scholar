<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Topic;
use App\Models\Status;
use App\Models\Faculty;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Idea>
 */
class IdeaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 5),
            'topic_id' => $this->faker->numberBetween(1, 5),
            'category_id' => $this->faker->numberBetween(1, 2),
            'status_id' => $this->faker->numberBetween(1, 5),
            'title' => ucwords($this->faker->words(4, true)),
            'description' => $this->faker->paragraph(5),
        ];
    }

    public function existing()
    {
        return $this->state(function (array $attributes) {
            return [
                'topic_id' => $this->faker->numberBetween(1, 5),
                'user_id' => $this->faker->numberBetween(1, 5),
                'category_id' => $this->faker->numberBetween(1, 2),
                'status_id' => $this->faker->numberBetween(1, 5),
            ];
        });
    }
}
