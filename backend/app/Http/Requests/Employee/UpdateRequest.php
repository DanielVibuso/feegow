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
            'name' => ['string', 'required'],
            'middle_name' => ['string'],
            'last_name' => ['string', 'required'],
            'cpf' => [new CpfValidator(), Rule::unique(Employee::class)->ignore($this->route()->id)],
            'birth_date' => ['required', 'date'],
            'comorbidity' => ['required', 'boolean']
        ];
    }
}
