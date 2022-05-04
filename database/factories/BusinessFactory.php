<?php

namespace Database\Factories;

use App\Models\Country;
use App\Models\Industry;
use Illuminate\Database\Eloquent\Factories\Factory;

class BusinessFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'email' => $this->faker->unique()->safeEmail(),
            'password' => $this->faker->password(8),
            'enabled' => 1,
            'phone' => $this->faker->phoneNumber(),
            'country_id' => Country::enabled()->inRandomOrder()->first()->id,
            'industry_id' => Industry::enabled()->inRandomOrder()->first()->id,
        ];
    }
}
