<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
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
        $requestRule = [
            'plate_number' => [
                'required',
                Rule::unique('cars')->ignore($this->id)
            ],
            'owner' => 'required',
            'travel_fee' => 'required|min:0',
            'plate_image' => 'mimes:jpg,jpeg,png'
        ];
        if ($this->id == null) {
            $requestRule['plate_image'] = "required|" . $requestRule['plate_image'];
        }
        return $requestRule;
    }
    public function messages()
    {
        return [
            'plate_number.required' => 'This is a required field',
            'plate_number.unique' => 'Plate number already exist',
            'owner.required' => 'This is a required field',
            'travel_fee.required' => 'This is a required field',
            'travel_fee.min' => 'Travel fee >= 0',
            'plate_image.required' => 'This is a required field',
            'plate_image.mimes' => 'Choose the right image format (jpg, jpeg, png)'
        ];
    }
}