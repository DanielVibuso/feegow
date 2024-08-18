<?php

namespace App\Http\Requests\Lot;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'lot_identify' => ['string', 'required', 'unique:lots,lot_identify'],
            'vaccine_id' => ['string', 'required', 'exists:vaccines,id'],
            'expiration' => ['date', 'required'],
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
            'required' => 'O campo :attribute é obrigatório.',
            'string' => 'O :attribute deve ser um texto.',
            'unique' => 'O :attribute já existe e não pode ser duplicado.',
            'exists' => 'O :attribute não foi encontrado no banco de dados.',
            'date' => 'O :attribute deve ser do tipo data.',
        ];
    }
}
