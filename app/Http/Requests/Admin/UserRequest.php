<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

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
        return [
            'name' => 'required',
            'email' => 'required|unique:users',
            'staff_code' => 'required|unique:users',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'User name cannot empty',
            'email.required' => 'User email cannot empty',
            'email.unique' => 'User email does exist',
            'staff_code.required' => 'User staff code cannot empty',
            'staff_code.unique' => 'User staff code does exist',
        ];
    }
}
