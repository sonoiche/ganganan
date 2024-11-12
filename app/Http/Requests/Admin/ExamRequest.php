<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ExamRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'          => 'required',
            'items'         => 'required',
            'status'        => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required'     => 'The assessment title field is required.',
            'items.required'    => 'The items count field is required.'
        ];
    }
}
