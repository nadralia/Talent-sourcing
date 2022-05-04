<?php

namespace Database\Factories;

use App\Models\Country;
use App\Models\Currency;
use App\Models\Gender;
use App\Models\JobStatus;
use App\Models\NoticePeriod;
use App\Models\RemoteType;
use App\Models\State;
use App\Models\Title;
use Illuminate\Database\Eloquent\Factories\Factory;

class TalentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'enabled'            => 1,
            'email'              => $this->faker->unique()->safeEmail(),
            'password'           => $this->faker->password(8),
            'first_name'         => $this->faker->firstName(),
            'last_name'          => $this->faker->lastName(),
            'title_id'           => Title::enabled()->inRandomOrder()->first()->id,
            'title_start_date'   => now()->subYears(mt_rand(2, 10))->startOfYear(),
            'phone'              => $this->faker->phoneNumber(),
            'birthday'           => $this->faker->date('m-d'),
            'nationality'        => Country::enabled()->inRandomOrder()->first()->id,
            'country_id'         => $country_id = Country::enabled()->whereHas('states')->inRandomOrder()->first()->id,
            'address'            => $this->faker->address(),
            'gender_id'          => Gender::enabled()->inRandomOrder()->first()->id,
            'min_salary'         => $min_salary = mt_rand(100000, 100000),
            'max_salary'         => $min_salary += mt_rand(10000, 1000000),
            'salary_currency_id' => Currency::enabled()->inRandomOrder()->first()->id,
            'notice_period_id'   => NoticePeriod::enabled()->inRandomOrder()->first()->id,
            'state_id'           => State::enabled()->whereCountryId($country_id)->inRandomOrder()->first()->id,
            'remote_type_id'     => RemoteType::enabled()->inRandomorder()->first()->id,
            'job_status_id'      => JobStatus::enabled()->inRandomOrder()->first()->id,
        ];
    }
}
