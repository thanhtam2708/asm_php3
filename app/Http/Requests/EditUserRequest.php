<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditUserRequest extends FormRequest
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
                Rule::unique('users')->ignore($this->id)
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($this->id)
            ],
            'avatar' => 'mimes:jpg,jpeg,png'
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
            'email.required' => 'This is a required field',
            'email.email' => 'Enter email in correct format',
            'email.unique' => 'Email already exist',
            'avatar.required' => 'This is a required field',
            'avatar.mimes' => 'Choose the right image format (jpg, jpeg, png)',
        ];
    }
}