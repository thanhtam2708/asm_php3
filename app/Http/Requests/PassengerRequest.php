<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PassengerRequest extends FormRequest
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
            'name' => [
                'required',
                Rule::unique('passengers')->ignore($this->id)
            ],
            'avatar' => 'mimes:jpg,jpeg,png',
            'travel_time' => 'required|after:tomorrow',
        ];
        if ($this->id == null) {
            $requestRule['avatar'] = "required|" . $requestRule['avatar'];
        }
        return $requestRule;
    }
    public function messages()
    {
        return [
            'name.required' => 'This is a required field',
            'name.unique' => 'Name already exist',
            'avatar.required' => 'This is a required field',
            'avatar.mimes' => 'Choose the right image format (jpg, jpeg, png)',
            'travel_time.required' => 'This is a required field',
            'travel_time.after' => 'Choose a date in the future'
        ];
    }
}