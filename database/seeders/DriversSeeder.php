<?php

namespace Database\Seeders;

use App\Models\Details;
use App\Models\Drivers;
use App\Models\Vehicles;
use Illuminate\Database\Seeder;

class DriversSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Drivers::factory()
            ->count(5)
            ->hasDetails(1)
            ->hasVehicles(1)
            ->create();
    }
}
