<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Faculty;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Department>
 */
final class DepartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->firstName(),
            'abbreviation' => $this->faker->word(),
            'description' => $this->faker->text,
            'faculty_id' => $this->faker->numberBetween(1, 3),
            'active' => 1,
        ];
    }

    // public function existing()
    // {
    //     return $this->state(function (array $attributes) {
    //         return [
    //             'faculty_id' => $this->faker->numberBetween(1, 3),
    //         ];
    //     });
    // }
}
