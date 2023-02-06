<?php

namespace Tests\Feature;

use App\Http\Resources\vehiclesResource;
use App\Models\Vehicles;
use App\Models\Drivers;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class vehicleTest extends TestCase
{
    use RefreshDatabase;

    public function test_non_empty_vehicles_table()
    {
//        $user = Vehicles::factory()->count(5)->create();
        $response = $this->getJson('http://127.0.0.1:8000/api/vehicles');
        $response->assertStatus(200);//not found
        $response->assertJson([
            'status' => "OK",
            'success' => true,
            'message' => "Vehicles found!"
        ],true);

//        $this->refreshTestDatabase();
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
//        $this->refreshTestDatabase();
    }

    public function test_get_vehicle()
    {
        $user = $this->createData2();
//        dd($user);
        $driver = $user->first();
//        dd($vehicle);
        $response = $this->getJson('http://127.0.0.1:8000/api/driver/'.$driver['id'].'/vehicle/');
        $response->assertStatus(200);
        $response->assertJson([
            'status' => "OK",
            'success' => true,
            'message' => "Driver vehicle found!"
        ],true);
//        $this->refreshTestDatabase();
    }

    public function test_update_vehicle()
    {
        $user = Vehicles::factory()->count(5)->create();
        $vehicle = $user->first();

        $response = $this->putJson('http://127.0.0.1:8000/api/vehicle/'.$vehicle['id'].'/',[
            "license_plate_number" => "CA12345678",
            "vehicle_make" => "Honda",
            "vehicle_model" => "Ballade",
            "year" => "2003",
            "insured" => false,
            "service_date" => "2002-06-15 07:41:15",
            "capacity" => 3,
            "drivers_id" => $vehicle['id']
        ]);
        $response->assertStatus(200);
        $response->assertJson([
        'status' => "OK",
        'success' => true,
        'message' => "Vehicle details updated!"
        ],true);
    }

    public function test_delete_driver_vehicle()
    {
        $user = Vehicles::factory()->count(5)->create();
        $vehicle = $user->first();

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
        $user = Drivers::factory()->count(5)->create();
        $vehicle = $user->first();

        $response = $this->postJson('http://127.0.0.1:8000/api/vehicle/',[
            'license_plate_number' => 'CA145236',
            'vehicle_make' => 'Toyota',
            'vehicle_model' => 'Justice',
            'year' => '2014',
            'insured' => true,
            'service_date' => '2013-09-04 21:35:45',
            'capacity' => 3,
            'drivers_id' => $vehicle['id']
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'status' => "OK",
            'success' => true,
            'message' => "Vehicle created!"
        ],true);
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function createData2(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return vehiclesResource::collection(Vehicles::factory()->count(5)->create());
    }

}
