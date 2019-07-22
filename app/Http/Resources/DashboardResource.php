<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DashboardResource extends JsonResource
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
            'district_id' => $this->district_id,
            'district_name' => $this->district_name,
            'communes' => JSON_decode($this->communes),
            'added' => $this->added,
            'updated' => $this->updated,
            'alive' => $this->alive,
            'almost_die' => $this->almost_die,
            'died' => $this->died,
            'all_road'=> $this->alive+$this->almost_die+$this->died
        ];
    } 
}
