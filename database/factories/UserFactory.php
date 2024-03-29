<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Department;
use App\Models\Level;
use App\Models\University;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
final class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'department_id' => $this->faker->numberBetween(1, 3),
            'level_id' => $this->faker->numberBetween(1, 5),
            'university_id' => $this->faker->numberBetween(1, 3),
            // 'email_verified_at' => now(),
            'trial_ends_at' => now()->addDays(7),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }

    // public function existing()
    // {
    //     return $this->state(function (array $attributes) {
    //         return [
    //             'level_id' => $this->faker->numberBetween(1,5),
    //             'university_id' => $this->faker->numberBetween(1, 3),
    //             'department_id' => $this->faker->numberBetween(1, 3),
    //         ];
    //     });
    // }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
