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
        'insured',
        'capacity'
    ];

    protected $casts = [ 'insured' => 'boolean' ];

    public function drivers()
    {
        return $this->belongsTo(Drivers::class, 'id','drivers_id');
    }
}
