<?php

namespace App\Http\Requests\Boundery;

use Illuminate\Foundation\Http\FormRequest;

class BounderyUpdateRequest extends FormRequest
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
        $except = $this->route('boundery')->id ?? '';
        return [
            'name'=>'required|unique:bounderies,name,'.$except.',id'
        ];
    }

    
}
