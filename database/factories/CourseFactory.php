<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'code' => $this->faker->countryCode(),
            'description' => $this->faker->text,
            'level_id' => rand(1, 5),
            // 'department_id' => \App\Models\Department::factory()->create()
        ];
    }
}
