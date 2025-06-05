<x-app-layout>
    @push('head')
    <link rel="stylesheet" href="{{ asset('css/citasindexusu.css') }}">
@endpush
    <div class="container py-5">
        <div class="row align-items-center mb-4 g-3">
            <div class="col-12 col-md-auto mb-2 mb-md-0">
                <a href="{{ url('/cliente/inicio') }}" class="btn-regresar w-100 w-md-auto">
                    ← Regresar al inicio
                </a>
            </div>
            <div class="col-12 col-md text-center">
                <h1 class="titulo-mis-citas m-0 text-break">Mis Citas</h1>
            </div>
            <div class="col-12 col-md-auto text-md-end mt-2 mt-md-0">
                <a href="{{ route('cliente.citas.create') }}"
                   class="btn-nueva-cita w-100 w-md-auto">
                    + Nueva Cita
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded mb-6 fw-semibold">
                {{ session('success') }}
            </div>
        @endif

        @if ($citas->isEmpty())
            <div class="bg-yellow-100 text-yellow-800 p-4 rounded fw-semibold">
                Aún no tienes citas registradas.
            </div>
        @else
            <div class="bg-white shadow rounded overflow-x-auto">
                <table class="table table-hover align-middle mb-0 w-100 citas-responsive-table">
                    <thead class="bg-gray-100 d-none d-md-table-header-group">
                        <tr>
                            <th class="px-4 py-3 text-start text-uppercase text-secondary fs-6 fw-bold">Fecha</th>
                            <th class="px-4 py-3 text-start text-uppercase text-secondary fs-6 fw-bold">Hora</th>
                            <th class="px-4 py-3 text-start text-uppercase text-secondary fs-6 fw-bold">Servicio</th>
                            <th class="px-4 py-3 text-start text-uppercase text-secondary fs-6 fw-bold">Estado</th>
                            <th class="px-4 py-3 text-start text-uppercase text-secondary fs-6 fw-bold">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach ($citas as $cita)
                            <tr class="d-block d-md-table-row mb-3 mb-md-0 border rounded shadow-sm shadow-md-0 citas-row-responsive">
                                <td class="px-4 py-3 fs-6 text-dark" data-label="Fecha">{{ \Carbon\Carbon::parse($cita->dia)->format('d/m/Y') }}</td>
                                <td class="px-4 py-3 fs-6 text-dark" data-label="Hora">{{ \Carbon\Carbon::parse($cita->hora)->format('H:i') }}</td>
                                <td class="px-4 py-3 fs-6 text-dark" data-label="Servicio">{{ ucwords(str_replace('_', ' ', $cita->tipo_servicio)) }}</td>
                                <td class="px-4 py-3 fs-6" data-label="Estado">
                                    <span class="px-2 py-1 rounded-pill text-xs fw-semibold
                                        {{ 
                                            $cita->estado === 'pendiente' ? 'bg-yellow-100 text-yellow-800' :
                                            ($cita->estado === 'confirmada' ? 'bg-blue-100 text-blue-800' :
                                            ($cita->estado === 'completada' ? 'bg-green-100 text-green-800' :
                                            ($cita->estado === 'cancelada' ? 'bg-red-100 text-red-800' :
                                            'bg-gray-100 text-gray-800')))
                                        }}">
                                        {{ ucfirst(str_replace('_', ' ', $cita->estado)) }}
                                    </span>
                                </td>
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-app-layout>