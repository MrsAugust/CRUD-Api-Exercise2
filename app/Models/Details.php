<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Details extends Model
{
    use HasFactory;

    protected $fillable = [
        'drivers_id',
        'home_address',
        'first_name',
        'last_name',
        'license_type'
    ];

    public function drivers()
    {
        return $this->belongsTo(Drivers::class, 'drivers_id','id');
    }
}
