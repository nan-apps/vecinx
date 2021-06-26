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
            'lat' => ['required', 'string', 'max:255'],
            'lng' => ['required', 'string', 'max:255'],
            'hood_id' => ['required', 'string', 'max:255'],
            'route_id' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
        ];

        if($this->route('address')){
            $rules['name'] = [
                'required', 'string', 'max:255',
                Rule::unique('addresses')->ignore($this->route('address')->id)
            ];
        } else {
            $rules['name'] = ['nullable','string', 'max:255', 'unique:App\Models\Address,name'];
        }

        return $rules;
    }
}
