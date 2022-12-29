<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Level;
use App\Models\Department;
use app\Enum\CourseStatusEnum;
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
            'level_id' => Level::factory()->create(),
            'user_id' => User::factory()->create(),
            'status' => CourseStatusEnum::RECENT,
            'department_id' => \App\Models\Department::factory()->create()
        ];
    }

    public function existing()
    {
        return $this->state(function (array $attributes) {
            return [
                'user_id' => $this->faker->numberBetween(1, 25),
                'level_id' => $this->faker->numberBetween(1, 5),
                'department_id' => $this->faker->numberBetween(1, 10),
            ];
        });
    }
}
