<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MapNeighbourResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->fullName(),
            'address' => $this->fullAddress(),
            'phone' => $this->phone,
            'lat' => $this->lat,
            'lng' => $this->lng,
            'iconPath' => "/images/map-markers/{$this->route->key}.png",
            'editPath' => '',
        ];
    }
}
