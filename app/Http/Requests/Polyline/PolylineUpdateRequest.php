<?php

namespace App\Http\Requests\Polyline;

use Illuminate\Foundation\Http\FormRequest;

class PolylineUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "vta_code"=>'max:191',
            "address_id"=>'numeric|exists:addresses,_code',
            "street_id"=>'numeric|exists:streets,id',
            "direction"=>'numeric|exists:directions,id',
            "average_price"=>'numeric',
            "minimum_price"=>'numeric',
            "maximum_price"=>'numeric',
            "corner_average_price"=>'numeric',
            "corner_minimum_price"=>'numeric',
            "corner_maximum_price"=>'numeric',
            'date_price'=>'date|date_format:Y-m-d',
        ];
    }
}
