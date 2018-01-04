<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PermissionRequest extends FormRequest
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
            'name' => 'required|string|max:30',
            'display_name' => 'required|max:30',
            'guard_name' => [
                'required',
                Rule::in(['web', 'admin'])
            ],
            'sort' => 'sometimes|nullable|integer',
            'permission_classify_id' => 'sometimes|nullable|integer|exists:permission_classifies,id'
        ];
    }
}
