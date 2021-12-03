<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
            'name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($this->id)
            ],
            'password' => 'required',
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
            'email.required' => 'This is a required field',
            'email.email' => 'Enter email in correct format',
            'email.unique' => 'Email already exist',
            'password.required' => 'This is a required field',
            'avatar.required' => 'This is a required field',
            'avatar.mimes' => 'Choose the right image format (jpg, jpeg, png)',
        ];
    }
}