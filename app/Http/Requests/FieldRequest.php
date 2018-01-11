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
        return [
            'table_id' => 'required|integer|exists:tables,id',
            'name' => 'required|string|max:20',
            'display_name' => 'required|string|max:30',
            'type' => 'required|string|max:20',
            'is_show' => 'required|integer',
            'sort' => 'sometimes|nullable|integer'
        ];
    }
}
