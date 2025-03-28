<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class JobRequest extends FormRequest
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
            'job_title'         => 'required',
            'workers_need'      => 'required',
            'workers_gender'    => 'required',
            'status'            => 'required',
            'salary'            => 'required',
            'salary_rate'       => 'required',
            'date_until'        => 'required',
            'photo'             => 'nullable|sometimes|image',
        ];
    }
}
