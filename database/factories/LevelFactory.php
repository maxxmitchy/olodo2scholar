<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Level>
 */
final class LevelFactory extends Factory
{
    public function definition(): mixed
    {
        return [
            'name' => $this->faker->word(),
        ];
    }
}
