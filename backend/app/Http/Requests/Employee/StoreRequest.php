<?php

namespace App\Http\Requests\Employee;

use App\Rules\CpfValidator;
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
            'name' => ['string', 'required'],
            'middle_name' => ['string'],
            'last_name' => ['string', 'required'],
            'cpf' => ['required', new CpfValidator(), 'unique:employees,cpf'],
            'birth_date' => ['required', 'date'],
            'comorbidity' => ['required', 'boolean']
        ];
    }
}
