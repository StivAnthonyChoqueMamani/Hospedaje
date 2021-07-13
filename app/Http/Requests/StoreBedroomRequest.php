<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        $rule_nro_unique = Rule::unique('bedrooms','nro');
        if($this->method()!=='POST'){
            $rule_nro_unique->ignore($this->id);
        }
        return [
            'nro' => ['required',$rule_nro_unique],
            'nro_beds' => 'required',
            'size_beds' => 'required',
            'floor' => 'required',
            'is_bath' => 'required',
            'price' => 'required',
        ];
    }
}
