@push('head')
<link rel="stylesheet" href="{{ asset('css/CrearInventario.css') }}">
@endpush

<x-app-layout>
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 col-xl-8">
                <div class="form-container shadow rounded p-4 bg-white">
                    <div class="form-header d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
                        <h1 class="mb-2 mb-md-0">Registrar Nuevo Producto</h1>
                        <a href="{{ route('admin.inventario.index') }}" class="btn-back-inventario">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24">
                                <path d="M10 19l-7-7m0 0l7-7m-7 7h18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Volver al inventario
                        </a>
                    </div>

                    @if ($errors->any())
                        <div class="form-error">
                            <h3>Hay {{ $errors->count() }} error(es) en el formulario:</h3>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.inventario.store') }}" method="POST" class="row g-3">
                        @csrf

                        <div class="col-12 col-md-6">
                            <label for="codigo" class="form-label">Código/SKU *</label>
                            <input type="text" name="codigo" id="codigo" value="{{ old('codigo') }}" required class="form-control">
                            <p class="text-gray-500 text-sm mt-1">Identificador único del producto</p>
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="categoria" class="form-label">Categoría *</label>
                            <select name="categoria" id="categoria" required class="form-select">
                                <option value="">Seleccione una categoría</option>
                                @foreach(['Tornillos', 'Bujías', 'Válvulas', 'Partes para motos', 'Lubricantes', 'Herramientas', 'Eléctricos'] as $categoria)
                                    <option value="{{ $categoria }}" {{ old('categoria') == $categoria ? 'selected' : '' }}>{{ $categoria }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12">
                            <label for="descripcion" class="form-label">Descripción *</label>
                            <input type="text" name="descripcion" id="descripcion" value="{{ old('descripcion') }}" required class="form-control">
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="proveedor_id" class="form-label">Proveedor *</label>
                            <select name="proveedor_id" id="proveedor_id" required class="form-select">
                                <option value="">Seleccione un proveedor</option>
                                @foreach ($proveedores as $proveedor)
                                    <option value="{{ $proveedor->id }}" {{ old('proveedor_id') == $proveedor->id ? 'selected' : '' }}>
                                        {{ $proveedor->nombre }} ({{ $proveedor->razon_social }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="estado" class="form-label">Estado del Producto</label>
                            <select name="estado" id="estado" class="form-select">
                                <option value="">No especificado</option>
                                <option value="bueno" {{ old('estado') == 'bueno' ? 'selected' : '' }}>Bueno</option>
                                <option value="dañado" {{ old('estado') == 'dañado' ? 'selected' : '' }}>Dañado</option>
                                <option value="en reparación" {{ old('estado') == 'en reparación' ? 'selected' : '' }}>En reparación</option>
                                <option value="devolución" {{ old('estado') == 'devolución' ? 'selected' : '' }}>En devolución</option>
                            </select>
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="cantidad" class="form-label">Cantidad en Stock *</label>
                            <input type="number" name="cantidad" id="cantidad" value="{{ old('cantidad', 0) }}" min="0" required class="form-control">
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="precio_unitario" class="form-label">Precio Unitario *</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" step="0.01" name="precio_unitario" id="precio_unitario" value="{{ old('precio_unitario', 0) }}" min="0" required class="form-control">
                                <span class="input-group-text">MXN</span>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="form-label">Valor Total Estimado</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="text" id="valor_total_preview" value="0.00" disabled class="form-control disabled-input">
                                <span class="input-group-text">MXN</span>
                            </div>
                        </div>

                        <div class="col-12 d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-primary px-4 d-flex align-items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="height:1.3rem;width:1.3rem;">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                Guardar Producto
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const cantidad = document.getElementById('cantidad');
                const precio = document.getElementById('precio_unitario');
                const total = document.getElementById('valor_total_preview');
                
                function formatCurrency(value) {
                    return parseFloat(value).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                }
                
                function calcularTotal() {
                    const c = parseFloat(cantidad.value) || 0;
                    const p = parseFloat(precio.value) || 0;
                    total.value = formatCurrency(c * p);
                }
                
                [cantidad, precio].forEach(el => {
                    el.addEventListener('input', calcularTotal);
                    el.addEventListener('change', calcularTotal);
                });
                
                calcularTotal();
            });
        </script>
    @endpush
</x-app-layout>