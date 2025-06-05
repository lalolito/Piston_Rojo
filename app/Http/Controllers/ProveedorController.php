<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProveedorController extends Controller
{
    // Mostrar lista de proveedores (con paginación)
    public function index()
    {
        $proveedores = Proveedor::orderBy('nombre')->paginate(10);
        return view('admin.proveedores.index', compact('proveedores'));
    }

    // Mostrar formulario de creación
    public function create()
    {
        return view('admin.proveedores.create');
    }

    // Validación centralizada para reutilización
    protected function validationRules($proveedorId = null)
    {
        return [
            'nombre' => 'required|string|max:255',
            'razon_social' => 'required|string|max:255',
            'direccion' => 'required|string|max:500',
            'rfc' => [
                'nullable',
                'string',
                'max:13',
                'regex:/^[A-ZÑ&]{3,4}\d{6}[A-V1-9][0-9A-Z]$/i'
            ],
            'curp' => [
                'nullable',
                'string',
                'max:18',
                'regex:/^[A-Z][AEIOUX][A-Z]{2}\d{2}(0[1-9]|1[0-2])(0[1-9]|[12]\d|3[01])[HM](AS|BC|BS|CC|CS|CH|CL|CM|DF|DG|GT|GR|HG|JC|MC|MN|MS|NT|NL|OC|PL|QT|QR|SP|SL|SR|TC|TS|TL|VZ|YN|ZS|NE)[B-DF-HJ-NP-TV-Z]{3}[0-9A-Z]\d$/i'
            ],
            'nit' => [
                'required',
                'string',
                'max:20',
                Rule::unique('proveedors')->ignore($proveedorId)
            ],
            'telefono' => 'required|string|max:20|regex:/^[0-9\-\+\(\)\s]{10,20}$/',
            'email' => 'required|email|max:255',
            'estado' => 'sometimes|in:activo,inactivo'
        ];
    }

    // Guardar nuevo proveedor
    public function store(Request $request)
    {
        $validated = $request->validate($this->validationRules());

        Proveedor::create($validated);

        return redirect()->route('admin.proveedores.index')
               ->with('success', 'Proveedor creado correctamente.');
    }

    // Mostrar formulario de edición
    public function edit($id)
    {
        $proveedor = Proveedor::findOrFail($id);
        return view('admin.proveedores.edit', compact('proveedor'));
    }

    // Actualizar proveedor existente
    public function update(Request $request, $id)
    {
        $proveedor = Proveedor::findOrFail($id);

        $validated = $request->validate($this->validationRules($proveedor->id));

        $proveedor->update($validated);

        return redirect()->route('admin.proveedores.index')
               ->with('success', 'Proveedor actualizado correctamente.');
    }

    // Cambiar estado activo/inactivo (usando PATCH mejor que GET)
    public function cambiarEstado(Request $request, $id)
    {
        $request->validate(['estado' => 'required|in:activo,inactivo']);
        
        $proveedor = Proveedor::findOrFail($id);
        $proveedor->update(['estado' => $request->estado]);

        return redirect()->route('admin.proveedores.index')
               ->with('success', 'Estado del proveedor actualizado.');
    }
}