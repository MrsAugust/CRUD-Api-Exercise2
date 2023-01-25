<?php

namespace Database\Factories;

use App\Models\Drivers;
use App\Models\Vehicles;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehiclesFactory extends Factory
{

    protected $model = Vehicles::class;

    public function definition()
    {

        $drivers_id = Drivers::factory();
        $license_plate_number = $this->faker->regexify('{A-Z}');
        $vehicle_make = $this->faker->regexify('{A-Z}');
        $vehicle_model = $this->faker->regexify('{A-Z}');
        $year = $this->faker->numberBetween(2000,2022);
        $insured = $this->faker->boolean();
        $capacity = $this->faker->randomDigit();
        $service_date = $this->faker->dateTimeThisCentury();

            return [
                'drivers_id' => $drivers_id,
                'license_plate_number' => $license_plate_number,
                'vehicle_make' => $vehicle_make,
                'vehicle_model' => $vehicle_model,
                'year' => $year,
                'insured' => $insured,
                'capacity' => $capacity,
                'service_date' => $service_date
            ];
    }
}
