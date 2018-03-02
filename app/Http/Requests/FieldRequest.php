<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FieldRequest extends FormRequest
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
        $rules = [
            'name' => 'required|string|max:20',
            'display_name' => 'required|string|max:30',
            'type' => 'sometimes|string|max:20',
            'is_show' => 'required|integer',
            'is_import' => 'required|integer',
            'collect' => 'sometimes|nullable|array',
            'belong' => 'required|integer',
            'sort' => 'sometimes|nullable|integer'
        ];
        if ($this->method() === 'POST') {
            $rules['table_id'] = 'required|integer|exists:tables,id';
            return $rules;
        } else {
            return $rules;
        }
    }
}
