<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreCitaRequest;
use App\Http\Requests\UpdateCitaRequest;

class CitasController extends Controller
{
    // ===========================
    // ADMIN
    // ===========================

    public function adminIndex()
    {
        $citas = Cita::orderBy('dia')->orderBy('hora')->get();
        return view('admin.citas.index', compact('citas'));
    }

    public function adminCreate()
    {
        $clientes = User::where('role', 'cliente')
            ->orderBy('name')
            ->get(['id', 'name', 'apellido', 'tipo_documento', 'numero_documento']);

        return view('admin.citas.create', compact('clientes'));
    }

    public function adminStore(StoreCitaRequest $request)
    {
        $data = $request->validated();

        if ($request->filled('cliente_id')) {
            $cliente = User::findOrFail($request->cliente_id);
            $data['user_id'] = $cliente->id;
            $data['nombre'] = $cliente->name;
            $data['apellido'] = $cliente->apellido ?? '';
            $data['tipo_documento'] = strtolower($cliente->tipo_documento);
            $data['numero_documento'] = $cliente->numero_documento;
        } else {
            $data['user_id'] = Auth::id(); // fallback (no debería pasar si usamos dropdown obligatorio)
        }

        // Validar duplicidad
        $existe = Cita::where('numero_documento', $data['numero_documento'])
                      ->where('dia', $data['dia'])
                      ->where('hora', $data['hora'])
                      ->exists();

        if ($existe) {
            return back()->withErrors(['hora' => 'Ya existe una cita para ese cliente en esa fecha y hora.'])->withInput();
        }

        Cita::create($data);

        return redirect()->route('admin.citas.index')->with('success', 'Cita registrada exitosamente.');
    }

    public function adminEdit($id)
    {
        $cita = Cita::findOrFail($id);
        return view('admin.citas.edit', compact('cita'));
    }

    public function adminUpdate(UpdateCitaRequest $request, $id)
    {
        $cita = Cita::findOrFail($id);
        $data = $request->validated();

        $existe = Cita::where('numero_documento', $data['numero_documento'])
                      ->where('dia', $data['dia'])
                      ->where('hora', $data['hora'])
                      ->where('id', '!=', $id)
                      ->exists();

        if ($existe) {
            return back()->withErrors(['hora' => 'Ya existe una cita para ese cliente en ese horario.'])->withInput();
        }

        $cita->update($data);

        return redirect()->route('admin.citas.index')->with('success', 'Cita actualizada correctamente.');
    }

    public function adminDelete($id)
    {
        Cita::destroy($id);
        return redirect()->route('admin.citas.index')->with('success', 'Cita eliminada.');
    }

    // ===========================
    // CLIENTE
    // ===========================

    public function clienteIndex()
    {
        $documento = Auth::user()->numero_documento;

        $citas = Cita::where('numero_documento', $documento)
                     ->orderBy('dia')
                     ->orderBy('hora')
                     ->get();

        return view('cliente.citas.index', compact('citas'));
    }

    public function clienteCreate()
    {
        return view('cliente.citas.create');
    }

    public function clienteStore(StoreCitaRequest $request)
    {
        $user = Auth::user();

        $data = $request->validated();
        $data['user_id'] = $user->id;
        $data['nombre'] = $user->name;
        $data['apellido'] = $user->apellido ?? '';
        $data['tipo_documento'] = strtolower($user->tipo_documento);
        $data['numero_documento'] = $user->numero_documento;

        $existe = Cita::where('numero_documento', $data['numero_documento'])
                      ->where('dia', $data['dia'])
                      ->where('hora', $data['hora'])
                      ->exists();

        if ($existe) {
            return back()->withErrors(['hora' => 'Ya tienes una cita en esa fecha y hora.'])->withInput();
        }

        Cita::create($data);

        return redirect()->route('cliente.citas.index')->with('success', 'Cita registrada con éxito.');
    }
}
