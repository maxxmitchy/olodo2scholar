<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\University>
 */
final class UniversityFactory extends Factory
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
