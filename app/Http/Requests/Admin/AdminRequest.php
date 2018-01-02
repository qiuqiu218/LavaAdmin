<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
            'username' => 'required|string|max:30|unique:admins,username',
            'nickname' => 'sometimes|nullable|max:30',
            'email' => 'sometimes|nullable|email',
            'phone' => 'sometimes|nullable|between:11,15',
            'password' => 'required|string|min:6'
        ];
    }
}
