<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'location'          => ['nullable', Rule::in(config('pangasinan.towns'))],
            'photo'             => 'nullable|sometimes|image',
        ];
    }

    protected function prepareForValidation(): void
    {
        if ($this->has('location') && $this->input('location') === '') {
            $this->merge(['location' => null]);
        }
    }
}
