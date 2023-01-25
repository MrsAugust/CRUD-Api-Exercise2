<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drivers extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_number',
        'phone_number'
    ];

    /**
     * Get the details of the category
     */
    public function details()
    {
        return $this->hasOne(Details::class);
    }

    public function vehicles()
    {
        return $this->hasOne(Vehicles::class,'drivers_id','id');  //hasMany
    }
}
