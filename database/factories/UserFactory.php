<?php

namespace Database\Factories;

use App\Models\User;
// use Illuminate\Foundation\Auth\Users;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{

//    protected $model = User::class;

    public function definition()
    {
        $name = ['John','Jane','Axel','Fox','Jacob','Bran','Carla','Mike','Suzie','Neil'];
        $surname = ['Doe','Addams','Code','Wick','Thomas','Swiss','Peace','Tutu','Evans','Moore'];

        return [
            'first_name' => $this->faker->randomElement($name),
            'last_name' => $this->faker->randomElement($surname),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
