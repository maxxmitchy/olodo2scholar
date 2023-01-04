<?php

namespace Database\Factories;

use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Option>
 */
class OptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'body' => $this->faker->text(50),
            'correct_option' => $this->faker->boolean(),
            'active' => true,
        ];
    }

    public function existing()
    {
        return $this->state(function (array $attributes) {
            return [
                'question_id' => $this->faker->numberBetween(1, 10),
            ];
        });
    }
}
