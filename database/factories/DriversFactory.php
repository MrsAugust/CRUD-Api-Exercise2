<?php

namespace Database\Factories;

use App\Models\User;
// use Illuminate\Foundation\Auth\Users;
use App\Models\Drivers;
use Illuminate\Database\Eloquent\Factories\Factory;

class DriversFactory extends Factory
{

    protected $model = Drivers::class;

    public function definition()
    {
        return [
            'users_id' => User::factory(),
            'id_number' => $this->faker->numerify('###############'),
            'phone_number' => $this->faker->numerify('+27#########'),
            'home_address' => $this->faker->streetAddress(),
            'license_type' => $this->faker->randomElement(['A','B','C','D']),
            'last_trip_date' => $this->faker->dateTimeThisDecade()
        ];
    }
}
