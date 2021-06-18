<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBedroomRequest extends FormRequest
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
            'nro' => 'required|unique:bedrooms,nro',
            'nro_beds' => 'required',
            'size_beds' => 'required',
            'floor' => 'required',
            'is_bath' => 'required',
            'price' => 'required',
        ];
    }
}
