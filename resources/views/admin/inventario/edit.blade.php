@push('head')
    <link rel="stylesheet" href="{{ asset('css/EditarInventario.css') }}">
@endpush

<x-app-layout>
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 col-xl-8">
                <div class="form-container shadow rounded p-4 bg-white">
                    <div class="form-header d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
                        <h1 class="mb-2 mb-md-0">Editar Producto: {{ $inventario->descripcion }}</h1>
                        <a href="{{ route('admin.inventario.index') }}" class="btn-back-inventario">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24">
                                <path d="M15 19l-7-7 7-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Volver al inventario
                        </a>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.inventario.update', $inventario->id) }}" method="POST" class="row g-3">
                        @csrf
                        @method('PUT')

                        <div class="col-12 col-md-6">
                            <label for="codigo" class="form-label">Código / SKU</label>
                            <input type="text" name="codigo" id="codigo" value="{{ old('codigo', $inventario->codigo) }}" required class="form-control">
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="categoria" class="form-label">Categoría</label>
                            <select name="categoria" id="categoria" required class="form-select">
                                <option value="">Seleccione una categoría</option>
                                @foreach (['Tornillos', 'Bujías', 'Válvulas', 'Partes para motos'] as $cat)
                                    <option value="{{ $cat }}" {{ old('categoria', $inventario->categoria) == $cat ? 'selected' : '' }}>
                                        {{ $cat }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <input type="text" name="descripcion" id="descripcion" value="{{ old('descripcion', $inventario->descripcion) }}" required class="form-control">
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="proveedor_id" class="form-label">Proveedor</label>
                            <select name="proveedor_id" id="proveedor_id" required class="form-select">
                                <option value="">Seleccione un proveedor</option>
                                @foreach ($proveedores as $proveedor)
                                    <option value="{{ $proveedor->id }}" {{ old('proveedor_id', $inventario->proveedor_id) == $proveedor->id ? 'selected' : '' }}>
                                        {{ $proveedor->nombre }} ({{ $proveedor->razon_social }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="estado" class="form-label">Estado del Producto</label>
                            <select name="estado" id="estado" class="form-select">
                                <option value="">No especificado</option>
                                @foreach (['bueno', 'dañado', 'en reparación'] as $estado)
                                    <option value="{{ $estado }}" {{ old('estado', $inventario->estado) == $estado ? 'selected' : '' }}>
                                        {{ ucfirst($estado) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="cantidad" class="form-label">Cantidad en Stock</label>
                            <input type="number" name="cantidad" id="cantidad" value="{{ old('cantidad', $inventario->cantidad) }}" required min="0" class="form-control">
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="precio_unitario" class="form-label">Precio Unitario</label>
                            <input type="number" step="0.01" name="precio_unitario" id="precio_unitario" value="{{ old('precio_unitario', $inventario->precio_unitario) }}" required min="0" class="form-control">
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="valor_total_preview" class="form-label">Valor Total (estimado)</label>
                            <input type="text" id="valor_total_preview" disabled class="form-control">
                        </div>

                        <div class="col-12 d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-primary px-4">Actualizar Producto</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const cantidad = document.getElementById('cantidad');
        const precio = document.getElementById('precio_unitario');
        const total = document.getElementById('valor_total_preview');

        function calcularTotal() {
            const c = parseFloat(cantidad.value) || 0;
            const p = parseFloat(precio.value) || 0;
            total.value = (c * p).toFixed(2);
        }

        cantidad.addEventListener('input', calcularTotal);
        precio.addEventListener('input', calcularTotal);
        window.addEventListener('DOMContentLoaded', calcularTotal);
    </script>
</x-app-layout>