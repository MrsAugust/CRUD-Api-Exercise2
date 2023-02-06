<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Foundation\Auth\Users;
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
       Vehicles::factory(5)->create();
    }
}
