<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
final class QuestionFactory extends Factory
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
                $this->questionable()
            ),
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
