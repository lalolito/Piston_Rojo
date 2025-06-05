<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateInventarioRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado a hacer esta solicitud
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Reglas de validación para actualizar inventario
     */
    public function rules(): array
    {
        return [
            'codigo' => [
                'required',
                'string',
                'max:50',
                Rule::unique('inventarios', 'codigo')->ignore($this->inventario->id),
            ],
            'descripcion' => 'required|string|max:255',
            'categoria' => 'required|string|max:100',
            'proveedor_id' => 'required|exists:proveedors,id',
            'cantidad' => 'required|integer|min:0',
            'precio_unitario' => 'required|numeric|min:0|max:999999.99',
            'estado' => 'nullable|string|max:50',
        ];
    }

    /**
     * Mensajes personalizados para errores de validación
     */
    public function messages(): array
    {
        return [
            'codigo.unique' => 'Este código ya está siendo utilizado por otro producto',
            'proveedor_id.exists' => 'El proveedor seleccionado no es válido',
            'cantidad.min' => 'La cantidad no puede ser un valor negativo',
            'precio_unitario.min' => 'El precio unitario no puede ser negativo',
            'precio_unitario.max' => 'El precio unitario excede el valor máximo permitido',
        ];
    }

    /**
     * Atributos personalizados para mensajes de error
     */
    public function attributes(): array
    {
        return [
            'proveedor_id' => 'proveedor',
            'precio_unitario' => 'precio unitario',
        ];
    }
}
