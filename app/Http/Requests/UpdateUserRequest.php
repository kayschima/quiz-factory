<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
        $user = $this->route('user');

        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user)],
            'roles' => ['required', 'array', 'min:1'],
            'roles.*' => ['required', 'string', 'exists:roles,name'],
        ];
    }

    /**
     * Get custom validation messages.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Der Name ist erforderlich.',
            'email.required' => 'Die E-Mail-Adresse ist erforderlich.',
            'email.email' => 'Bitte gib eine gültige E-Mail-Adresse an.',
            'email.unique' => 'Diese E-Mail-Adresse ist bereits vergeben.',
            'roles.required' => 'Mindestens eine Rolle muss ausgewählt werden.',
            'roles.array' => 'Die Rollen-Auswahl ist ungültig.',
            'roles.min' => 'Mindestens eine Rolle muss ausgewählt werden.',
            'roles.*.exists' => 'Mindestens eine ausgewählte Rolle ist ungültig.',
        ];
    }
}
