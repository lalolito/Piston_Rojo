<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use App\Models\Proveedor;
use App\Http\Requests\StoreInventarioRequest;
use App\Http\Requests\UpdateInventarioRequest;
use Illuminate\Http\Request;

class InventarioController extends Controller
{
    /**
     * Muestra el listado paginado de productos en inventario
     */
    public function index(Request $request)
    {
        $query = Inventario::with('proveedor')
            ->orderBy('descripcion');

        if ($request->filled('search')) {
            $search = trim($request->search);
            $searchLower = strtolower($search);

            $query->where(function($q) use ($searchLower) {
                $q->whereRaw('LOWER(descripcion) LIKE ?', ["%{$searchLower}%"])
                  ->orWhereRaw('LOWER(categoria) LIKE ?', ["%{$searchLower}%"])
                  ->orWhereHas('proveedor', function($q2) use ($searchLower) {
                      $q2->whereRaw('LOWER(nombre) LIKE ?', ["%{$searchLower}%"]);
                  });
            });
        }

        if ($request->filled('estado_stock')) {
            $query->where('estado_stock', $request->estado_stock);
        }

        $inventarios = $query->paginate(10);

        return view('admin.inventario.index', compact('inventarios'));
    }

    /**
     * Muestra el formulario para crear un nuevo producto
     */
    public function create()
    {
        $proveedores = Proveedor::activos()
            ->orderBy('nombre')
            ->get(['id', 'nombre', 'razon_social']);

        return view('admin.inventario.create', compact('proveedores'));
    }

    /**
     * Almacena un nuevo producto en el inventario
     */
    public function store(StoreInventarioRequest $request)
    {
        $data = $request->validated();
        $data['valor_total'] = $this->calcularValorTotal($data['cantidad'], $data['precio_unitario']);
        $data['estado_stock'] = $this->determinarEstadoStock($data['cantidad']);

        Inventario::create($data);

        return redirect()->route('admin.inventario.index')
            ->with('success', 'Producto agregado correctamente al inventario.');
    }

    /**
     * Muestra el formulario para editar un producto
     */
    public function edit(Inventario $inventario)
    {
        $proveedores = Proveedor::activos()
            ->orderBy('nombre')
            ->get(['id', 'nombre', 'razon_social']);

        return view('admin.inventario.edit', compact('inventario', 'proveedores'));
    }

    /**
     * Actualiza un producto existente en el inventario
     */
    public function update(UpdateInventarioRequest $request, Inventario $inventario)
    {
        $data = $request->validated();
        $data['valor_total'] = $this->calcularValorTotal($data['cantidad'], $data['precio_unitario']);
        $data['estado_stock'] = $this->determinarEstadoStock($data['cantidad']);

        $inventario->update($data);

        return redirect()->route('admin.inventario.index')
            ->with('success', 'Producto actualizado correctamente.');
    }

    /**
     * Elimina un producto del inventario
     */
    public function destroy(Inventario $inventario)
    {
        $inventario->delete();

        return redirect()->route('admin.inventario.index')
            ->with('success', 'Producto eliminado del inventario.');
    }

    /**
     * Calcula el valor total del producto
     */
    private function calcularValorTotal(int $cantidad, float $precioUnitario): float
    {
        return $cantidad * $precioUnitario;
    }

    /**
     * Determina el estado del stock según la cantidad disponible
     */
    private function determinarEstadoStock(int $cantidad): string
    {
        if ($cantidad === 0) {
            return Inventario::STOCK_SIN;
        } elseif ($cantidad < 10) {
            return Inventario::STOCK_BAJO;
        } elseif ($cantidad < 50) {
            return Inventario::STOCK_MEDIO;
        }

        return Inventario::STOCK_ALTO;
    }
}
