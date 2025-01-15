<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UpdateClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function attributes()
    {
        return [
            'company_id' => 'Empresa',
            'name' => 'Nome',
            'email' => 'Email',
            'phone' => 'Telefone',
            'type' => 'Tipo de cliente',

            'address.street' => 'Logradouro',
            'address.number' => 'Número',
            'address.zipcode' => 'CEP',
            'address.neighborhood' => 'Bairro',
            'address.city_name' => 'Cidade',
            'address.province_code' => 'Estado',

            'person_number' => 'CPF',
            'business_number' => 'CNPJ',
            'file' => 'Arquivo'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'company_id' => 'required',
            'name' => 'required',
            'email' => 'required|unique:clients,email,' . $this->id,
            'person_number' => 'required_if:type,individual',
            'business_number' => 'required_if:type,legal_entity',

            'address.street' => 'required',
            'address.number' => 'required',
            'address.zipcode' => 'required',
            'address.neighborhood' => 'required',
            'address.city_name' => 'required',
            'address.province_code' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'required_if' => 'O campo :attribute é obrigatório',
            'required' => 'O campo :attribute é obrigatório',
            'unique' => 'O campo :attribute já existe',
            'max' => 'O campo :attribute deve ter no máximo :max caractéres'
        ];
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
