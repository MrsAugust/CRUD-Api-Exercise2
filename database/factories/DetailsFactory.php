<?php

namespace Database\Factories;

use App\Models\Details;
use App\Models\Drivers;
use Illuminate\Database\Eloquent\Factories\Factory;

class DetailsFactory extends Factory
{

    protected $model = Details::class;

    public function definition()
    {

        $drivers_id = Drivers::factory();
        $first_name = $this->faker->name();
        $last_name = $this->faker->name();
        $home_address = $this->faker->streetAddress();
        $license_type = $this->faker->randomElement(['A','B','C','D']);
        $last_trip_date = $this->faker->dateTimeThisDecade();

            return [
                'drivers_id' => $drivers_id,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'home_address' => $home_address,
                'license_type' => $license_type,
                'last_trip_date' => $last_trip_date
            ];
    }
}
