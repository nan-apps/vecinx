<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddressRequest extends FormRequest
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

        $rules = [
            'lat' => ['required'],
            'lng' => ['required'],
            'hood_id' => ['required'],
            'route_id' => ['required']
        ];

        if($this->route('address')){
            $rules['address'] = [
                'required',
                Rule::unique('addresses')->ignore($this->route('address')->id)
            ];
        } else {
            $rules['address'] = 'unique:App\Models\Address,address';
        }

        return $rules;
    }
}
