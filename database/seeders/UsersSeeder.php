<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        // Seed test user 1
//        $seededEmail = 'jane.doe@test.com';
//        $user = User::where('email', '=', $seededEmail)->first();
//        if ($user === null) {
//            $user = User::create([
//                'first_name'                           => 'Jane',
//                'last_name'                           => 'Doe',
//                'email'                          => $seededEmail,
//                'password'                       => Hash::make('password'),
//            ]);
//        }
//
//        // Seed test user 2
//        $user = User::where('email', '=', 'user@user.com')->first();
//        if ($user === null) {
//            $user = User::create([
//                'first_name'                           => 'John',
//                'last_name'                           => 'Code',
//                'email'                          => 'john.code@test.com',
//                'password'                       => Hash::make('password'),
//            ]);
//        }
//
//        // Seed test user 3
//        $user = User::where('email', '=', 'user@user.com')->first();
//        if ($user === null) {
//            $user = User::create([
//                'first_name'                           => 'Sky',
//                'last_name'                           => 'Cole',
//                'email'                          => 'sky.cole@test.com',
//                'password'                       => Hash::make('password'),
//            ]);
//        }
//
//        // Seed test user 4
//        $user = User::where('email', '=', 'user@user.com')->first();
//        if ($user === null) {
//            $user = User::create([
//                'first_name'                           => 'Yazeed',
//                'last_name'                           => 'Case',
//                'email'                          => 'yazeed.case@test.com',
//                'password'                       => Hash::make('password'),
//            ]);
//        }
//
//        // Seed test user 5
//        $user = User::where('email', '=', 'user@user.com')->first();
//        if ($user === null) {
//            $user = User::create([
//                'first_name'                           => 'Zara',
//                'last_name'                           => 'Zain',
//                'email'                          => 'zara.zain@test.com',
//                'password'                       => Hash::make('password'),
//            ]);
//        }

         User::factory()
             ->count(5)
             ->hasDrivers(1)
             ->create();
    }
}
