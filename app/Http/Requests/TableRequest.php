<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TableRequest extends FormRequest
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
            'display_name' => 'required|string|max:30',
            'is_sub_table' => 'sometimes|nullable|integer',
            'type' => 'required|integer'
        ];
        if ($this->method() === 'POST') {
            $rules['name'] = 'required|string|max:20|unique:tables,name';
            return $rules;
        } else {
            return $rules;
        }
    }
}
