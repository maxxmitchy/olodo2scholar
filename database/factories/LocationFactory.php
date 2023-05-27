<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Location>
 */
final class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'country' => 'Nigeria',
            'addressLine1' => $this->faker->address(),
            'addressLine2' => $this->faker->streetAddress(),
            // 'city_id' => City::factory()->create(),
        ];
    }
}
