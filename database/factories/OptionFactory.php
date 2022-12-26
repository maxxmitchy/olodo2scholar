<?php

namespace Database\Factories;

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
            // 'question_id' => $questions->random(1)->pluck('id')->first(),
        ];
    }
}
