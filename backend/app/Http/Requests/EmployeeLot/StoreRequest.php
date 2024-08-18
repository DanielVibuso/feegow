<?php

namespace App\Http\Requests\EmployeeLot;

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

    protected function prepareForValidation()
    {
        $this->merge([
            'employee_id' => $this->route('employee'),
            'lot_id' => $this->route('lot'),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'employee_id' => ['uuid', 'required', 'exists:employees,id'],
            'lot_id' => ['uuid', 'required', 'exists:lots,id'],
            'applied_at' => ['date', 'required']
        ];
    }
}
