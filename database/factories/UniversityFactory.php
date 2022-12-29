<?php

namespace Database\Factories;

use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\University>
 */
class UniversityFactory extends Factory
{
    public function definition(): mixed
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'location_id' => Location::factory()->create(),
        ];
    }
}
