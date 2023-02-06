<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drivers extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'id_number',
        'phone_number',
        'home_address',
        'last_trip_date',
        'license_type'
    ];

    public static function create(array $array,$id)
    {

        $driver = new Drivers();
        $driver->users_id = $id;
        $driver->id_number = $array['id_number'];
        $driver->phone_number = $array['phone_number'];
        $driver->home_address = $array['home_address'];
        $driver->license_type = $array['license_type'];
        $driver->save();
        return $driver;
    }

    /**
     * Get the details of the category
     */

    public function users()
    {
        return $this->belongsTo(User::class, 'users_id','id');
    }

    public function vehicles()
    {
        return $this->hasMany(Vehicles::class,'drivers_id','id');  //hasMany
    }
}
