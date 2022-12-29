<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Topic>
 */
class TopicFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word,
            'body' => $this->faker->text,
            'overview' => $this->faker->text(),
            'course_id' => Course::factory()->create(),
        ];
    }

    public function existing()
    {
        return $this->state(function (array $attributes) {
            return [
                'course_id' => $this->faker->numberBetween(1, 20),
            ];
        });
    }
}
