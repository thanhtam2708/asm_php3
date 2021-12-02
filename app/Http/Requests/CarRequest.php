<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarRequest extends FormRequest
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
            'plate_number' => 'required|unique:cars',
            'owner' => 'required',
            'travel_fee' => 'required|min:0',
            'plate_image' => 'required|mimes:jpg,jpeg,png',
        ];
    }
    public function messages()
    {
        return [
            'plate_number.required' => 'This is a required field',
            'plate_number.unique' => 'Plate number already exist',
            'owner.required' => 'This is a required field',
            'travel_fee.required' => 'This is a required field',
            'plate_image.required' => 'This is a required field',
            'plate_image.mimes' => 'Choose the right image format (jpg, jpeg, png)'
        ];
    }
}