<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Apartment>
 */
class ApartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'address' => $this->faker->streetName(),
            'city' => $this->faker->city(),
            'postal_code' => $this->faker->postcode(),
            'rented_price' => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 3000),
            'rented' => $this->faker->boolean(),
            'user_id' => User::all()->random()->id
        ];
    }
}
