<?php

namespace Database\Seeders;

use App\Models\Details;
use App\Models\Drivers;
use App\Models\Vehicles;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

//        Drivers::factory(5)->create();
//        Details::factory(5)->create();
//        Vehicles::factory(5)->create();
        $this->call([DriversSeeder::class]);
    }
}
