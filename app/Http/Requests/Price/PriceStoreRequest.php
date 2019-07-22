<?php

namespace App\Http\Requests\Price;

use Illuminate\Foundation\Http\FormRequest;

class PriceStoreRequest extends FormRequest
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
            'road_id'=>'required|exists:polylines,id',
            'average_price'=>'required|numeric',
            'minimum_price'=>'required|numeric',
            'maximum_price'=>'required|numeric',
            'corner_average_price'=>'numeric',
            'corner_minimum_price'=>'numeric',
            'corner_maximum_price'=>'numeric',
            'date_price'=>'required|date|date_format:Y-m-d',
        ];
    }
}
