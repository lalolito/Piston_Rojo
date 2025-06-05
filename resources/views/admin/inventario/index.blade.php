<x-app-layout>
    @push('head')
        <link rel="stylesheet" href="{{ asset('css/EstilosInicioInventario.css') }}">
    @endpush

    <div class="max-w-7xl mx-auto py-4 px-2">
        <!-- Cabecera -->
        <div class="row align-items-center mb-4 g-3">
            <div class="col-12 col-md-auto mb-2 mb-md-0 d-flex align-items-center">
                <a href="http://127.0.0.1:8000/admin/inicio" class="btn-regresar">
                    ← Volver al inicio
                </a>
            </div>
            <div class="col-12 col-md text-center mb-2 mb-md-0">
                <h1 class="text-3xl font-bold m-0">Inventario de Productos</h1>
            </div>
            <div class="col-12 col-md-auto text-md-end">
                <a href="{{ route('admin.inventario.create') }}" class="bg-red-600 hover:bg-red-700 button-primary">
                    + Nuevo Producto
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-800 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Filtros -->
        <div class="mb-4">
            <form method="GET" action="{{ route('admin.inventario.index') }}" class="row g-3 align-items-end">
                <div class="col-12 col-md-4">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar por descripción..."
                        class="border px-3 py-2 rounded w-100" autocomplete="off">
                </div>
                <div class="col-12 col-md-4">
                    <select name="estado_stock" class="border px-3 py-2 rounded w-100">
                        <option value="">Filtrar por estado de stock</option>
                        <option value="alto_stock" {{ request('estado_stock') == 'alto_stock' ? 'selected' : '' }}>Alto stock</option>
                        <option value="medio_stock" {{ request('estado_stock') == 'medio_stock' ? 'selected' : '' }}>Medio stock</option>
                        <option value="bajo_stock" {{ request('estado_stock') == 'bajo_stock' ? 'selected' : '' }}>Bajo stock</option>
                        <option value="sin_stock" {{ request('estado_stock') == 'sin_stock' ? 'selected' : '' }}>Sin stock</option>
                    </select>
                </div>
                <div class="col-12 col-md-2">
                    <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-700 w-100">
                        Filtrar
                    </button>
                </div>
            </form>
        </div>

        <!-- Tabla -->
        <div class="overflow-x-auto bg-white shadow rounded-lg">
            <table class="min-w-full text-sm text-left table table-hover align-middle mb-0 inventario-responsive-table">
                <thead class="bg-gray-100 text-xs font-medium uppercase text-gray-500">
                    <tr>
                        <th class="px-4 py-2">Código</th>
                        <th class="px-4 py-2">Descripción</th>
                        <th class="px-4 py-2">Categoría</th>
                        <th class="px-4 py-2">Proveedor</th>
                        <th class="px-4 py-2 text-center">Cantidad</th>
                        <th class="px-4 py-2">P. Unitario</th>
                        <th class="px-4 py-2">Total</th>
                        <th class="px-4 py-2">Stock</th>
                        <th class="px-4 py-2">Estado</th>
                        <th class="px-4 py-2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($inventarios as $item)
                        <tr>
                            <td class="px-4 py-2 font-mono" data-label="Código">{{ $item->codigo }}</td>
                            <td class="px-4 py-2" data-label="Descripción">{{ $item->descripcion }}</td>
                            <td class="px-4 py-2" data-label="Categoría">{{ $item->categoria }}</td>
                            <td class="px-4 py-2" data-label="Proveedor">{{ $item->proveedor->nombre ?? '-' }}</td>
                            <td class="px-4 py-2 text-center" data-label="Cantidad">{{ $item->cantidad }}</td>
                            <td class="px-4 py-2" data-label="P. Unitario">${{ number_format($item->precio_unitario, 2) }}</td>
                            <td class="px-4 py-2" data-label="Total">${{ number_format($item->valor_total, 2) }}</td>
                            <td class="px-4 py-2" data-label="Stock">
                                @php
                                    $color = match($item->estado_stock) {
                                        'alto_stock' => 'bg-green-100 text-green-800',
                                        'medio_stock' => 'bg-yellow-100 text-yellow-800',
                                        'bajo_stock' => 'bg-orange-100 text-orange-800',
                                        'sin_stock' => 'bg-red-100 text-red-800',
                                        default => 'bg-gray-200 text-gray-700',
                                    };
                                    $textoEstado = str_replace('_', ' ', ucfirst($item->estado_stock));
                                @endphp
                                <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full {{ $color }}">
                                    {{ $textoEstado }}
                                </span>
                            </td>
                            <td class="px-4 py-2 capitalize" data-label="Estado">{{ $item->estado ?? '—' }}</td>
                            <td class="px-4 py-2" data-label="Acciones">
                                <div class="d-flex flex-wrap gap-2">
                                    <a href="{{ route('admin.inventario.edit', $item->id) }}" class="button-edit">Editar</a>
                                    <form action="{{ route('admin.inventario.destroy', $item->id) }}" method="POST"
                                        onsubmit="return confirm('¿Deseas eliminar este producto?');" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline btn p-0 border-0 bg-transparent">Eliminar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="px-4 py-4 text-center text-gray-500">No hay productos registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $inventarios->appends(request()->query())->links() }}
        </div>
    </div>
</x-app-layout>