<?php

namespace App\Http\Resources;

use App\Models\User;
use App\Models\Vehicles;
use Illuminate\Http\Resources\Json\JsonResource;

class userResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $user = User::find($this->users_id);
        return [
            'id' => $this->id,
            'home_address' => $this->home_address,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'license_type' => $this->license_type,
            'last_trip_date' => $this->last_trip_date
        ];
    }
}
