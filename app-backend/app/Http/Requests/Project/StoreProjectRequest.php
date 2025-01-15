<?php

namespace App\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class StoreProjectRequest extends FormRequest
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
            'title' => 'Titulo',
            'description' => 'Descrição',
            'client_id' => 'Cliente',
            'begin_date' => 'Data de Inicio',
            'due_date' => 'Data de Termino',

            'members.user_id' => 'ID do Membro',
            'members.role' => 'Papel do membro',
            // 'address.zipcode' => 'CEP',
            // 'address.neighborhood' => 'Bairro',
            // 'address.city_name' => 'Cidade',
            // 'address.province_code' => 'Estado',
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
            'title' => 'required',
            'client_id' => 'required',
            'begin_date' => 'required',
            'due_date' => 'required',

            'members' => 'required|array',
            'members.*.user_id' => 'required',
            'members.*.role' => 'required|string|in:owner,member',
        ];
    }

    public function messages(): array
    {
        return [
            'required_if' => 'O campo :attribute é obrigatório',
            'required' => 'O campo :attribute é obrigatório',
            'unique' => 'O campo :attribute já existe',
            'max' => 'O campo :attribute deve ter no máximo :max caractéres',
            'in' => 'O campo :attribute deve ser um dos seguintes valores: :values'
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
