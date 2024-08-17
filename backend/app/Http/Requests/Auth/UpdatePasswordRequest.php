<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
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
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
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
            'token.required' => 'Obrigatório informar o token',
            'email.required' => 'Obrigatório informar a email',
            'email.email' => 'Campo "email" não possui um email válido',
            'password.required' => 'Obrigatório informar a nova senha',
            'password.confirmed' => 'Obrigatório confirmar a nova senha',
            'password.min' => 'Nova senha deve possuir no mínimo 8 caracteres',
        ];
    }
}
