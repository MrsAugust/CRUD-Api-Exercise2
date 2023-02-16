<?php

namespace Tests\Feature;

use App\Models\Drivers;
use App\Models\User;
use App\Models\Vehicles;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class driverTest extends TestCase
{
    use RefreshDatabase;

    public function test_non_empty_drivers_table()
    {
        $response = $this->getJson('http://127.0.0.1:8000/api/drivers/');
        $response->assertStatus(200);
        $response->assertJson([
            'status' => "OK",
            'success' => true,
            'message' => "Drivers found!"
        ],true);
    }

    public function test_get_driver()
    {
        User::factory()->create();
        $driver = Drivers::factory()->create();

        $response = $this->getJson('http://127.0.0.1:8000/api/driver/'.$driver['id'].'/');
        $response->assertStatus(200);
        $response->assertJson([
            'status' => "OK",
            'success' => true,
            'message' => "Found driver account!"
        ],true);

    }

    public function test_get_driver_error()
    {
        User::factory()->create();
        $driver = Drivers::factory()->create();

        $response = $this->getJson('http://127.0.0.1:8000/api/driver/'.($driver['id']+1).'/');
        $response->assertStatus(404);
        $response->assertJson([
            'status' => "ERROR",
            'success' => false,
            'message' => "Could not find driver account!"
        ],true);

    }

    public function test_update_driver()
    {
        User::factory()->create();
        $driver = Drivers::factory()->create();

        $response = $this->putJson('http://127.0.0.1:8000/api/drivers/'.$driver['id'].'/',[
            'id_number' => '9236587459',
            'phone_number' => '0216987458'
        ]);
        $response->assertStatus(200);
        $response->assertJson([
        'status' => "OK",
        'success' => true,
        'message' => "Driver account updated!"
        ],true);

    }

    public function test_update_driver_error()
    {
        User::factory()->create();
        $driver = Drivers::factory()->create();

        $response = $this->putJson('http://127.0.0.1:8000/api/drivers/'.$driver['id'].'/',[
            'id_number' => '9236587452545',
            'phone_number' => '0216987458abc452523512366abd'
        ]);
        $response->assertStatus(404);
        $response->assertJson([
            'status' => "ERROR",
            'success' => false,
            'message' => "Driver account could not be updated!"
        ],true);

    }

    public function test_update_driver_details()
    {
        User::factory()->create();
        $driver = Drivers::factory()->create();

        $response = $this->putJson('http://127.0.0.1:8000/api/drivers/'.$driver['id'].'/details',[
            'id_number' => '9236587459',
            'phone_number' => '0216987458',
            'home_address' => '12 Kloof Street',
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'license_type' => 'A'
        ]);
        $response->assertStatus(200);
        $response->assertJson([
        'status' => "OK",
        'success' => true,
        'message' => "Driver information updated!"
        ],true);

    }

    public function test_update_driver_details_error()
    {
        User::factory()->create();
        $driver = Drivers::factory()->create();

        $response = $this->putJson('http://127.0.0.1:8000/api/drivers/'.$driver['id'].'/details',[
            'id_number' => '9236587459',
            'phone_number' => '0216987458',
            'home_address' => '12 Kloof Street',
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'license_type' => 'BD'
        ]);
        $response->assertStatus(404);
        $response->assertJson([
            'status' => "ERROR",
            'success' => false,
            'message' => "Driver account could not be updated!"
        ],true);

    }

    public function test_delete_driver()
    {
        User::factory()->create();
        $driver = Drivers::factory()->create();

        $response = $this->deleteJson('http://127.0.0.1:8000/api/drivers/'.$driver['id'].'/');
        $response->assertStatus(200);
        $response->assertJson([
        'status' => "OK",
        'success' => true,
        'message' => "Driver account deleted!"
        ],true);

    }

    public function test_delete_driver_details()
    {
        User::factory()->create();
        $driver = Drivers::factory()->create();

        $response = $this->deleteJson('http://127.0.0.1:8000/api/drivers/'.$driver['id'].'/details');
        $response->assertStatus(200);
        $response->assertJson([
        'status' => "OK",
        'success' => true,
        'message' => "Driver information deleted!"
        ],true);

    }

    public function test_create_driver()
    {
        $response = $this->postJson('http://127.0.0.1:8000/api/driver/',[
            'id_number' => '123456789124',
            'phone_number' => '0216957845',
            'home_address' => '1 Strand Street',
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'license_type' => 'B'
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'status' => "OK",
            'success' => true,
            'message' => "Driver account created!"
        ],true);
    }

    public function test_create_driver_error()
    {
        $response = $this->postJson('http://127.0.0.1:8000/api/driver/',[
            'id_number' => '1234567891244562315235',
            'phone_number' => '0216957845',
            'home_address' => '1 Strand Street',
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'license_type' => 'BX'
        ]);

        $response->assertStatus(404);
        $response->assertJson([
            'status' => "ERROR",
            'success' => false,
            'message' => "Driver account could not be created!"
        ],true);
    }

    public function test_response_structure(){

        $response = $this->postJson('http://127.0.0.1:8000/api/driver/',[
            'id_number' => '9234567891248',
            'phone_number' => '216957845',
            'home_address' => '1 Strand Street',
            'first_name' => 'Jack',
            'last_name' => 'Deer',
            'license_type' => 'C'
        ]);

        $this->assertDatabaseHas('drivers',[
            'id' => $response->id,
            'id_number' => '9234567891248',
            'phone_number' => '216957845',
            'home_address' => '1 Strand Street',
            'license_type' => 'C'
        ]);

        $this->assertDatabaseHas('users',[
            'id' => $response->users_id,
            'first_name' => 'Jack',
            'last_name' => 'Deer',
        ]);

    }
    public function test_response_items(){

    }
    public function test_database_structure(){

    }

    public function test_database_items(){

    }

}
