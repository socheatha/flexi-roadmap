<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PriceResource extends JsonResource
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
            'road_name' => optional($this->polyline)->vta_code,
            'average_price' => $this->average_price,
            'minimum_price' => $this->minimum_price,
            'maximum_price' => $this->maximum_price,
            'corner_average_price' => $this->corner_average_price,
            'corner_minimum_price' => $this->corner_minimum_price,
            'corner_maximum_price' => $this->corner_maximum_price,
            'date_price' => $this->date_price,
        ];
    }
    
}
