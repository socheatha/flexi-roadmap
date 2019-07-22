<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChartResource extends JsonResource
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
            'date_price' => $this->date_price,
            'average_price' => $this->average_price,
            'year' => ($this->date_price)?\Carbon\Carbon::parse($this->date_price)->format('Y'):null,
            'month' => ($this->date_price)?\Carbon\Carbon::parse($this->date_price)->format('M'):null,
        ];
    }
}
