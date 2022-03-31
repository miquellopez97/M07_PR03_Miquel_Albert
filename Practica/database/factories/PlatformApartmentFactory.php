<?php

namespace Database\Factories;

use App\Models\Apartment;
use App\Models\Platform;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Platform_Apartment>
 */
class PlatformApartmentFactory extends Factory
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
            'apartment_id' => $this->App/Apartment::inRandomOrder()->value('id'),
            'platform_id' => $this->App/Platform::inRandomOrder()->value('id')
        ];
    }
}
