@push('head')
<link rel="stylesheet" href="{{ asset('css/EditarProveedor.css') }}">
@endpush

<x-app-layout>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8 col-xl-7">
                <div class="bg-white shadow rounded p-4">
                    <h1 class="text-3xl font-bold mb-4 text-gray-900 text-center text-break">
                        Editar Proveedor
                    </h1>

                    @if ($errors->any())
                        <div class="alert alert-danger bg-red-100 text-red-800 p-4 rounded mb-4">
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.proveedores.update', $proveedor->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row g-3 mb-4">
                            <div class="col-12 col-md-6">
                                <label for="nombre" class="form-label fw-semibold">Nombre Comercial</label>
                                <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $proveedor->nombre) }}" required class="form-control">
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="razon_social" class="form-label fw-semibold">Razón Social</label>
                                <input type="text" name="razon_social" id="razon_social" value="{{ old('razon_social', $proveedor->razon_social) }}" required class="form-control">
                            </div>
                            <div class="col-12">
                                <label for="direccion" class="form-label fw-semibold">Dirección</label>
                                <input type="text" name="direccion" id="direccion" value="{{ old('direccion', $proveedor->direccion) }}" required class="form-control">
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="nit" class="form-label fw-semibold">NIT (Número Interno)</label>
                                <input type="text" name="nit" id="nit" value="{{ old('nit', $proveedor->nit) }}" required class="form-control">
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="telefono" class="form-label fw-semibold">Teléfono</label>
                                <input type="text" name="telefono" id="telefono" value="{{ old('telefono', $proveedor->telefono) }}" required class="form-control">
                            </div>
                            <div class="col-12">
                                <label for="email" class="form-label fw-semibold">Correo Electrónico</label>
                                <input type="email" name="email" id="email" value="{{ old('email', $proveedor->email) }}" required class="form-control">
                            </div>
                            <div class="col-12">
                                <label for="estado" class="form-label fw-semibold">Estado</label>
                                <select name="estado" id="estado" class="form-select">
                                    <option value="activo" {{ old('estado', $proveedor->estado) === 'activo' ? 'selected' : '' }}>Activo</option>
                                    <option value="inactivo" {{ old('estado', $proveedor->estado) === 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                                </select>
                            </div>
                        </div>

                        <div class="row g-2 pt-3">
                            <div class="col-12 col-md-6">
                                <a href="{{ route('admin.proveedores.index') }}"
                                   class="btn btn-outline-secondary w-100">
                                    ← Volver al listado
                                </a>
                            </div>
                            <div class="col-12 col-md-6">
                                <button type="submit"
                                        class="btn btn-primary w-100 fw-semibold">
                                    Guardar Cambios
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>