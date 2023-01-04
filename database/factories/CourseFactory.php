<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Level;
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
            'level_id' => $this->faker->numberBetween(1, 5),
            'user_id' => $this->faker->numberBetween(1, 5),
            'status' => \App\Enum\CourseStatusEnum::RECENT,
            'department_id' => $this->faker->numberBetween(1, 3)
        ];
    }

    // public function existing()
    // {
    //     return $this->state(function (array $attributes) {
    //         return [
    //             'user_id' => $this->faker->numberBetween(1, 5),
    //             'level_id' => $this->faker->numberBetween(1, 5),
//             'department_id' => $this->faker->numberBetween(1, 3),
    //         ];
    //     });
    // }
}
