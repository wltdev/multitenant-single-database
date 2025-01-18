<?php

namespace App\Http\Requests\Lead;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class StoreLeadRequest extends FormRequest
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
            'title' => 'titulo',
            'description' => 'descricao',
            'kanban_board_column_id' => 'coluna',
            'kanban_board_column_order' => 'ordem coluna',
            'status' => 'status',
            'budget' => 'orcamento',
            'priority' => 'prioridade'
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
            'title' => 'required|max:255',
            'description' => 'max:255',
            'status' => 'max:255',
            'budget' => 'max:255',
            'priority' => 'max:255|in:low,medium,high',
            'kanban_board_column_id' => 'integer',
            'kanban_board_column_order' => 'integer'
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'enum' => 'O campo :attribute deve ser um dos seguintes: low, medium, high',
            'integer' => 'O campo :attribute deve ser um número'
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
