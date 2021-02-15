<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NeighbourRequest extends FormRequest
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
            'enable' => ['boolean'],
            'name' => ['required'],
            'address' => ['required'],
            'lat' => ['required'],
            'lng' => ['required'],
            'hood_id' => ['required'],
            'birthdate' => ['date_format:d/m/Y'],
        ];
    }
}
