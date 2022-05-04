<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'     => $this->faker->name,
            'email'    => $this->admin_email = $this->faker->email(),
            'password' => $this->admin_email = $this->faker->password(8),
            'enabled'  => true,
        ];
    }
}
