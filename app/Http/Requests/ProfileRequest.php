<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
        $id = $this->input('id');
        return [
            'fname'             => 'required',
            'lname'             => 'required',
            'email'             => 'reqiured|email|unique:users,email,' . (($id) ? $id : null) . ',id',
            'contact_number'    => 'required',
            'address'           => 'required',
            'city'              => 'required',
            'zip_code'          => 'required',
            'user_type'         => 'required',
            'photo'             => 'nullable|sometimes|image',
            'password'          => 'nullable|sometimes|min:8|confirmed'
        ];
    }
}
