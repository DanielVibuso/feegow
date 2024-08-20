<?php

namespace App\Http\Requests\Employee;

use App\Models\Employee;
use App\Rules\CpfValidator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
            'name' => ['string'],
            'middle_name' => ['string'],
            'last_name' => ['string'],
            'cpf' => [new CpfValidator(),  'max:11', Rule::unique(Employee::class)->ignore($this->route()->id), 'regex:/^[0-9]+$/'],
            'birth_date' => ['date'],
            'comorbidity' => ['boolean']
        ];
    }


    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'email' => 'O :attribute fornecido não é válido.',
            'string' => 'O :attribute deve ser um texto.',
            'unique' => 'O :attribute já existe e não pode ser duplicado.',
            'date' => 'O :attribute deve ser do tipo data.',
            'boolean' => 'O :attribute deve ser do tipo true ou false.',
            'regex' => 'O :attribute possui formato invalido'
        ];
    }
}
