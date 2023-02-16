<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicles extends Model
{
    use HasFactory;

    protected $fillable = [
        'drivers_id',
        'license_plate_number',
        'vehicle_make',
        'vehicle_model',
        'year',
        'service_date',
        'insured',
        'capacity'
    ];

    protected $filters = ['vehicle_make', 'service_date', 'capacity', 'year'];

    protected $casts = [ 'insured' => 'boolean' ];

    public static function create(array $array)
    {
        $vehicle = new Vehicles();
        $vehicle->drivers_id = $array['drivers_id'];
        $vehicle->license_plate_number = $array['license_plate_number'];
        $vehicle->vehicle_make = $array['vehicle_make'];
        $vehicle->vehicle_model = $array['vehicle_model'];
        $vehicle->year = $array['year'];
        $vehicle->insured = $array['insured'];
        $vehicle->service_date = $array['service_date'];
        $vehicle->capacity = $array['capacity'];
        $vehicle->save();
        return $vehicle;
    }


    public function drivers()
    {
        return $this->belongsTo(Drivers::class, 'id','drivers_id');
    }
}
