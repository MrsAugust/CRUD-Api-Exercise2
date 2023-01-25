<?php

namespace Database\Factories;

use App\Models\Drivers;
use Illuminate\Database\Eloquent\Factories\Factory;

class DriversFactory extends Factory
{

    protected $model = Drivers::class;

    public function definition()
    {
        $id_number = $this->faker->phoneNumber();
        $phone_number = $this->faker->phoneNumber();

            return [
                'id_number' => $id_number,
                'phone_number' => $phone_number
            ];
    }
}
