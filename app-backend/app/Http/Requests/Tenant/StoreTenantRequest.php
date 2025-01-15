<?php

namespace App\Http\Requests\Tenant;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class StoreTenantRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'email' => 'required|unique:users|max:255',
            'password' => 'required|min:6|max:255',
            'company' => 'required|max:255'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'name is required',
            'email.required' => 'email is required',
            'email.unique' => 'email is already used',
            'password.required' => 'password is required',
            'password.min' => 'password must be at least 6 characters long',
            'company.required' => 'company is required'
        ];
    }

    protected function prepareForValidation()
    {
        if (!isset($this->domain)) {
            return;
        }

        $this->merge(['domain' => $this->domain . '.localhost']);
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors()
        ], 422));
    }
}
