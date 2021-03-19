<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MapAddressResource extends JsonResource
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
            'address' => $this->fullAddress(),
            'lat' => $this->lat,
            'lng' => $this->lng,
            'iconPath' => "/images/map-markers/{$this->route->key}.png",
            'neighbours' => NeighbourResource::collection($this->neighbours),
            'editPath' => '',
        ];
    }
}
