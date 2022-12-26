<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Question::class;

    public function definition()
    {
        return [
            'content' => $this->faker->text,
            'explanation' => $this->faker->text,
            'question_type_id' => 1,
        ];
    }

    public function configure()
    {
        return $this->for(
            static::factoryForModel(
                $this->questionable()),
            'questionable'
        );
    }

    public function questionable()
    {
        return $this->faker->randomElement([
            Quiz::class,
        ]);
    }
}
