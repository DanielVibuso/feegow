<?php

namespace App\Http\Requests\Vaccine;

use App\Models\Vaccine;
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
            'name' => ['string', Rule::unique(Vaccine::class)->ignore($this->route()->id)],
            'booster_interval' => ['numeric'],
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
            'string' => 'O :attribute deve ser um texto.',
            'unique' => 'O :attribute já está cadastrado.',
            'numeric' => 'O :attribute deve ser do tipo numérico.',
        ];
    }
}
