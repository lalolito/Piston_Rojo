<x-app-layout>
@push('head')
    <link rel="stylesheet" href="{{ asset('css/citasindex.css') }}">
@endpush

<div class="container py-4">
    <div class="row align-items-center mb-4 g-3">
        <div class="col-12 col-md-auto mb-2 mb-md-0 text-center text-md-start">
            <a href="http://127.0.0.1:8000/admin/inicio" class="btn-regresar">
                ← Volver al inicio
            </a>
        </div>
        <div class="col-12 col-md text-center">
            <h1 class="text-2xl font-bold text-gray-800 m-0">Listado de Citas</h1>
        </div>
        <div class="col-12 col-md-auto text-center text-md-end mt-2 mt-md-0">
            <a href="{{ route('admin.citas.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded d-inline-block">
                + Nueva Cita
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if($citas->isEmpty())
        <div class="text-center text-gray-600">No hay citas registradas.</div>
    @else
        <div class="table-responsive bg-white shadow rounded-lg" style="overflow-x:auto;">
            <table class="table align-middle mb-0 min-w-full divide-y divide-gray-200 w-100 admin-citas-responsive-table">
                <thead class="table-light">
                    <tr>
                        <th class="px-2 px-md-4 py-2 text-left text-sm font-semibold text-dark">Fecha</th>
                        <th class="px-2 px-md-4 py-2 text-left text-sm font-semibold text-dark">Hora</th>
                        <th class="px-2 px-md-4 py-2 text-left text-sm font-semibold text-dark">Cliente</th>
                        <th class="px-2 px-md-4 py-2 text-left text-sm font-semibold text-dark">Documento</th>
                        <th class="px-2 px-md-4 py-2 text-left text-sm font-semibold text-dark">Servicio</th>
                        <th class="px-2 px-md-4 py-2 text-left text-sm font-semibold text-dark">Estado</th>
                        <th class="px-2 px-md-4 py-2 text-left text-sm font-semibold text-dark">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($citas as $cita)
                        <tr class="hover:bg-gray-50">
                            <td class="px-2 px-md-4 py-2" data-label="Fecha">{{ \Carbon\Carbon::parse($cita->dia)->format('d/m/Y') }}</td>
                            <td class="px-2 px-md-4 py-2" data-label="Hora">{{ \Carbon\Carbon::parse($cita->hora)->format('H:i') }}</td>
                            <td class="px-2 px-md-4 py-2" data-label="Cliente">{{ $cita->nombre }} {{ $cita->apellido }}</td>
                            <td class="px-2 px-md-4 py-2" data-label="Documento">{{ strtoupper($cita->tipo_documento) }} {{ $cita->numero_documento }}</td>
                            <td class="px-2 px-md-4 py-2 capitalize" data-label="Servicio">{{ str_replace('_', ' ', $cita->tipo_servicio) }}</td>
                            <td class="px-2 px-md-4 py-2" data-label="Estado">
                                <span class="text-sm font-semibold px-2 py-1 rounded
                                    {{ $cita->estado === 'pendiente' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $cita->estado === 'confirmada' ? 'bg-blue-100 text-blue-800' : '' }}
                                    {{ $cita->estado === 'completada' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $cita->estado === 'cancelada' ? 'bg-red-100 text-red-800' : '' }}
                                    {{ $cita->estado === 'no_asistio' ? 'bg-gray-100 text-gray-800' : '' }}">
                                    {{ ucfirst(str_replace('_', ' ', $cita->estado)) }}
                                </span>
                            </td>
                            <td class="px-4 py-2" data-label="Acciones">
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.citas.edit', $cita->id) }}" class="text-blue-600 hover:underline">Editar</a>
                                    <form action="{{ route('admin.citas.delete', $cita->id) }}" method="POST" onsubmit="return confirm('¿Eliminar esta cita?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline bg-transparent border-0 p-0" style="background:none;border:none;padding:0;">Eliminar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
</x-app-layout>