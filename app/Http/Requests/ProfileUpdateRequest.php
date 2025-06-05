<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Autoriza la solicitud.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Reglas de validación para la actualización del perfil.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'apellido' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($this->user()->id),
            ],
            'tipo_documento' => [
                'required',
                'string',
                Rule::in(['CC', 'TI', 'CE', 'NIT']),
            ],
            'numero_documento' => [
                'required',
                'string',
                'max:50',
                Rule::unique('users')->ignore($this->user()->id),
            ],
            'fecha_nacimiento' => ['nullable', 'date'],
            'telefono' => ['required', 'string', 'max:20'],
        ];
    }
}
