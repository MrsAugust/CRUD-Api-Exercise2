<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drivers extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_number',
        'phone_number',
        'last_trip_date',
        'license_type'
    ];

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
