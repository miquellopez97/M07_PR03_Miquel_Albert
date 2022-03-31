<?php

namespace Database\Factories;

use App\Models\Apartment;
use App\Models\Platform;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Platform_Apartment>
 */
class Platform_ApartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'register_date' => $this->faker->date(),
            'premium' => $this->faker->boolean($chanceOfGettingTrue = 20),
            'apartment_id' => Apartment::all()->random()->id,
            'platform_id' => Platform::all()->random()->id
        ];
    }
}
