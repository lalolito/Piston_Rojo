<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInventarioRequest extends FormRequest
{
    /**
     * Autorizar la validación
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Reglas de validación para el inventario
     */
    public function rules(): array
    {
        return [
            'codigo' => 'required|string|max:50|unique:inventarios,codigo',
            'descripcion' => 'required|string|max:255',
            'categoria' => 'required|string|max:100',
            'proveedor_id' => 'required|exists:proveedors,id',
            'cantidad' => 'required|integer|min:0',
            'precio_unitario' => 'required|numeric|min:0|max:999999.99',
            'estado' => 'nullable|string|max:50',
        ];
    }

    /**
     * Mensajes personalizados de validación
     */
    public function messages(): array
    {
        return [
            'codigo.unique' => 'El código ya está en uso por otro producto',
            'proveedor_id.exists' => 'El proveedor seleccionado no existe',
            'precio_unitario.min' => 'El precio no puede ser negativo',
            'cantidad.min' => 'La cantidad no puede ser negativa',
        ];
    }

    /**
     * Atributos personalizados para mensajes de error
     */
    public function attributes(): array
    {
        return [
            'proveedor_id' => 'proveedor',
        ];
    }
}
