<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Business>
 */
class BusinessFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->company();
        $country = Country::inRandomOrder()->whereHas('states')->first();

        $state = null;
        if ($country) {
            $state = State::whereCountryId($country->id)->whereHas('cities')->inRandomOrder()->first();
        }

        $city = null;
        if ($state) {
            $city = City::whereStateId($state->id)->inRandomOrder()->first();
        }

        return [
            'name' => $name,
            'slug' => Str::slug($name) . rand(100000,9999999),
            'about' => fake()->paragraph(),
            'email' => fake()->email() . rand(100000,9999999),
            'doc' => fake()->randomNumber(),
            'country_id' => $country?->id,
            'state_id' => $state?->id,
            'city_id' => $city?->id,
            'address' => fake()->address()
        ];
    }
}
