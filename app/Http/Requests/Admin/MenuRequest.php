<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
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
            'title' => 'required|max:30',
            'description' => 'sometimes|nullable|max:120',
            'parent_id' => 'sometimes|nullable|integer',
            'route' => 'sometimes|nullable|max:120',
            'type' => 'required',
            'sort' => 'sometimes|nullable|integer',
        ];
    }
}
