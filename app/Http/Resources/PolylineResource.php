<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PolylineResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $start = explode(',',$this->starting_point_coordinat);
        $end = explode(',',$this->ending_point_coordinate);
        return [
            'id' => $this->id,
            'vta_code' => $this->vta_code,
            'address' => optional($this->address)->_name_en,
            'street' => optional($this->street)->name,
            'bounderies' => $this->bounderies,
            'starting_point_place' => $this->starting_point_place,
            'ending_point_place' => $this->ending_point_place,
            'direction' => optional($this->directionName)->name,
            'polylines' => $this->polylines? $this->polylines:\Polyline::encode([$start,$end]),
            'distance' => $this->distance,
            'from_distance' => $this->from_distance,
            'to_distance' => $this->to_distance,
            'average_price' => $this->average_price,
            'minimum_price' => $this->minimum_price,
            'maximum_price' => $this->maximum_price,
            'date_price' => $this->date_price,
            'priced_by' => $this->priced_by,
        ];
    }
}
