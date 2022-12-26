<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Department>
 */
class DepartmentFactory extends Factory
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
            'active' => 1,
            // 'faculty_id' => Faculty::factory()->create(),
        ];
    }
}
