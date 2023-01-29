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
        $id_number = $this->faker->phoneNumber();
        $phone_number = $this->faker->phoneNumber();
        $users_id = User::factory();
        $home_address = $this->faker->streetAddress();
        $license_type = $this->faker->randomElement(['A','B','C','D']);
        $last_trip_date = $this->faker->dateTimeThisDecade();

            return [
                'users_id' => $users_id,
                'id_number' => $id_number,
                'phone_number' => $phone_number,
                'home_address' => $home_address,
                'license_type' => $license_type,
                'last_trip_date' => $last_trip_date
            ];
    }
}
