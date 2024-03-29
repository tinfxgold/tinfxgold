<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequestUser extends FormRequest
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
            'name' => 'required|unique:users',
            'email' => 'required',
            'password' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Không để trống',
            'email.required' => 'Không để trống',
            'email.unique' => 'Đã tồn tại',
            'password.required' => 'Không để trống',
        ];
    }
}
