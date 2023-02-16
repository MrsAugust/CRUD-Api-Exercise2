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
        $cars = ['Toyota','Honda','Chevrolet','Nissan','Mercedez','BMW','Range Rover','Audi'];
        $model = ['i20','Civic','Sedan','Hilux','Ballade','Beetle','C-class','M-Series','A3','Fortuner'];

        return [
            'drivers_id' => Drivers::factory(),
            'license_plate_number' => $this->faker->text(maxNbChars: 10),
            'vehicle_make' => $this->faker->randomElement($cars),
            'vehicle_model' => $this->faker->randomElement($model),
            'year' => $this->faker->numberBetween(2000,2022),
            'insured' => $this->faker->boolean(),
            'capacity' => $this->faker->numberBetween(1,22),
            'service_date' => $this->faker->dateTimeThisDecade()
        ];
    }
}
