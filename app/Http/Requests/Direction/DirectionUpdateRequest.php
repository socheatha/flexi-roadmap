<?php

namespace App\Http\Requests\Direction;

use Illuminate\Foundation\Http\FormRequest;

class DirectionUpdateRequest extends FormRequest
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
        $except = $this->route('direction')->id ?? '';
        return [
            'name'=>'required|unique:directions,name,'.$except.',id'
        ];
    }
}
