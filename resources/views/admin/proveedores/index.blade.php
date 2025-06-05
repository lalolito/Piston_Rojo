<x-app-layout>
    @push('head')
        <link rel="stylesheet" href="{{ asset('css/Proveedores.css') }}">
    @endpush

    <div class="container py-4">
        <div class="row align-items-center mb-4 g-3">
            <div class="col-12 col-md-auto mb-2 mb-md-0">
                <a href="http://127.0.0.1:8000/admin/inicio" class="btn-regresar btn-volver-inicio">
                    ← Volver al inicio
                </a>
            </div>
            <div class="col-12 col-md text-center">
                <div class="w-100">
                    <h1 class="text-3xl font-bold text-gray-900 m-0 text-break">Gestión de Proveedores</h1>
                </div>
            </div>
            <div class="col-12 col-md-auto text-md-end mt-2 mt-md-0">
                <a href="{{ route('admin.proveedores.create') }}"
                   class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md d-inline-flex align-items-center gap-2 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Nuevo Proveedor
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-50 border-start border-4 border-green-500 p-4 mb-4 rounded">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ms-3">
                        <p class="text-sm text-green-700 mb-0">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="table-responsive">
                <table class="table align-middle mb-0 proveedores-responsive-table">
                    <thead style="background:#111;">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-white text-uppercase">Nombre</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-white text-uppercase">Razón Social</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-white text-uppercase">NIT</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-white text-uppercase">Teléfono</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-white text-uppercase">Estado</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-white text-uppercase">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($proveedores as $proveedor)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-4 py-3 text-sm fw-bold text-gray-900" data-label="Nombre">{{ $proveedor->nombre }}</td>
                                <td class="px-4 py-3 text-sm text-gray-500" data-label="Razón Social">{{ $proveedor->razon_social }}</td>
                                <td class="px-4 py-3 text-sm text-gray-500 font-mono" data-label="NIT">{{ $proveedor->nit }}</td>
                                <td class="px-4 py-3 text-sm text-gray-500" data-label="Teléfono">{{ $proveedor->telefono }}</td>
                                <td class="px-4 py-3" data-label="Estado">
                                    <span class="px-2 inline-flex text-xs fw-semibold rounded-full {{ $proveedor->estado === 'activo' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ ucfirst($proveedor->estado) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm" data-label="Acciones">
                                    <div class="d-flex flex-wrap gap-3">
                                        <a href="{{ route('admin.proveedores.edit', $proveedor->id) }}"
                                           class="text-indigo-600 hover:text-indigo-900 d-inline-flex align-items-center gap-1 justify-content-center"
                                           title="Editar proveedor">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                            </svg>
                                            Editar
                                        </a>
                                        <form action="{{ route('admin.proveedores.estado', $proveedor->id) }}" method="POST"
                                              onsubmit="return confirm('¿Confirmas cambiar el estado de este proveedor?');">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="estado" value="{{ $proveedor->estado === 'activo' ? 'inactivo' : 'activo' }}">
                                            <button type="submit"
                                                    class="d-inline-flex align-items-center gap-1 justify-content-center {{ $proveedor->estado === 'activo' ? 'text-red-600 hover:text-red-900' : 'text-green-600 hover:text-green-900' }}"
                                                    title="Haz clic para {{ $proveedor->estado === 'activo' ? 'inactivar' : 'activar' }} a {{ $proveedor->nombre }}">
                                                @if ($proveedor->estado === 'activo')
                                                    <!-- Ícono de desactivar -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.54-10.46a1 1 0 00-1.415 0L10 9.586 7.875 7.46a1 1 0 10-1.414 1.415L8.586 11l-2.125 2.125a1 1 0 101.414 1.415L10 12.414l2.125 2.126a1 1 0 001.415-1.415L11.414 11l2.126-2.125a1 1 0 000-1.415z" clip-rule="evenodd" />
                                                    </svg>
                                                    Inactivar
                                                @else
                                                    <!-- Ícono de activar -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm-1.707-7.293a1 1 0 011.414 0L14 7.414a1 1 0 10-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 1.414l2 2z" clip-rule="evenodd" />
                                                    </svg>
                                                    Activar
                                                @endif
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-4 text-center text-sm text-gray-500">
                                    No se encontraron proveedores registrados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($proveedores->hasPages())
                <div class="bg-white px-4 py-3 border-top border-gray-200">
                    {{ $proveedores->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>