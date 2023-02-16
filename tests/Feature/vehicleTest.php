<?php

namespace Tests\Feature;

use App\Http\Resources\vehiclesResource;
use App\Models\User;
use App\Models\Vehicles;
use App\Models\Drivers;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class vehicleTest extends TestCase
{
    use RefreshDatabase;

    public function test_non_empty_vehicles_table()
    {
        $user = Vehicles::factory()->count(5)->create();
        $response = $this->getJson('http://127.0.0.1:8000/api/vehicles');
        $response->assertStatus(200);//not found
        $response->assertJson([
            'status' => "OK",
            'success' => true,
            'message' => "Vehicles found!"
        ],true);

    }

    public function test_get_vehicle_error()
    {
        $response = $this->getJson('http://127.0.0.1:8000/api/driver/5e/vehicle/');
        $response->assertStatus(404);
        $response->assertJson([
            'status' => "ERROR",
            'success' => false,
            'message' => "Driver vehicle not found"
        ],true);
    }

    public function test_get_vehicle()
    {
        User::factory()->create();
        Drivers::factory()->create();
        $vehicle = Vehicles::factory()->create();

        $response = $this->getJson('http://127.0.0.1:8000/api/driver/'.$vehicle['drivers_id'].'/vehicle/');
        $response->assertStatus(200);
        $response->assertJson([
            'status' => "OK",
            'success' => true,
            'message' => "Driver vehicle found!"
        ],true);
    }

    public function test_update_vehicle()
    {
        User::factory()->create();
        Drivers::factory()->create();
        $vehicle = Vehicles::factory()->create();

        $response = $this->putJson('http://127.0.0.1:8000/api/vehicle/'.$vehicle['id'].'/',[
            "license_plate_number" => "CA12345678",
            "vehicle_make" => "Honda",
            "vehicle_model" => "Ballade",
            "year" => "2003",
            "insured" => false,
            "service_date" => "2002-06-15 07:41:15",
            "capacity" => 3,
            "drivers_id" => $vehicle['drivers_id']
        ]);
        $response->assertStatus(200);
        $response->assertJson([
        'status' => "OK",
        'success' => true,
        'message' => "Vehicle details updated!"
        ],true);
    }

    public function test_update_vehicle_error()
    {
        User::factory()->create();
        Drivers::factory()->create();
        $vehicle = Vehicles::factory()->create();

        $response = $this->putJson('http://127.0.0.1:8000/api/vehicle/'.$vehicle['id'].'/',[
            "license_plate_number" => "CA1234567814562",
            "vehicle_make" => "Honda",
            "vehicle_model" => "Ballade",
            "year" => "2003",
            "insured" => false,
            "service_date" => "2002-06-15 07:41:15",
            "capacity" => 3,
            "drivers_id" => $vehicle['drivers_id']
        ]);
        $response->assertStatus(404);
        $response->assertJson([
            'status' => "ERROR",
            'success' => false,
            'message' => "Vehicle details could not be updated."
        ],true);
    }

    public function test_delete_driver_vehicle()
    {
        User::factory()->create();
        Drivers::factory()->create();
        $vehicle = Vehicles::factory()->create();

        $response = $this->deleteJson('http://127.0.0.1:8000/api/vehicle/'.$vehicle['id'].'/');
        $response->assertStatus(200);
        $response->assertJson([
        'status' => "OK",
        'success' => true,
        'message' => "Vehicle deleted!"
        ],true);

    }

    public function test_create_vehicle()
    {
        User::factory()->create();
        $driver = Drivers::factory()->create();

        $response = $this->postJson('http://127.0.0.1:8000/api/vehicle/',[
            'license_plate_number' => 'CA145236',
            'vehicle_make' => 'Toyota',
            'vehicle_model' => 'Justice',
            'year' => '2014',
            'insured' => true,
            'service_date' => '2013-09-04 21:35:45',
            'capacity' => 3,
            'drivers_id' => $driver['id']
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'status' => "OK",
            'success' => true,
            'message' => "Vehicle created!"
        ],true);
    }

    public function test_create_vehicle_error()
    {
        User::factory()->create();
        $driver = Drivers::factory()->create();

        $response = $this->postJson('http://127.0.0.1:8000/api/vehicle/',[
            'license_plate_number' => 'CA1452364153221',
            'vehicle_make' => 'Toyota',
            'vehicle_model' => 'Justice',
            'year' => '2077',
            'insured' => true,
            'service_date' => '2013-09-04 21:35:45',
            'capacity' => 3,
            'drivers_id' => $driver['id']
        ]);

        $response->assertStatus(404);
        $response->assertJson([
            'status' => "ERROR",
            'success' => false,
            'message' => "Vehicle could not be created."
        ],true);
    }

    public function test_response_structure(){

    }
    public function test_response_items(){

    }
    public function test_database_structure(){

    }

    public function test_database_items(){

    }

}
