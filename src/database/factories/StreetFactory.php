<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Street;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Street>
 */
class StreetFactory extends Factory
{

    protected $model = Street::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->streetName(),
            'city_id' => City::get()->random()->id,
        ];
    }
}
