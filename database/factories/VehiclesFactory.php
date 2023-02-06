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
        $license_plate_number = $this->faker->text(maxNbChars: 10);
        $vehicle_make = $this->faker->text(maxNbChars: 15);
        $vehicle_model = $this->faker->text(maxNbChars: 15);
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
