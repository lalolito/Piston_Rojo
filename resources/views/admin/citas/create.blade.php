<x-app-layout>
    @push('head')
        <link rel="stylesheet" href="{{ asset('css/crearcitas.css') }}">
    @endpush

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8 col-xl-7">
                <div class="bg-white shadow rounded p-4">
                    <h2 class="text-2xl font-bold mb-4 text-gray-800 text-break">Crear Cita para Cliente</h2>

                    @if ($errors->any())
                        <div class="alert alert-danger bg-red-100 text-red-800 p-4 rounded mb-4">
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.citas.store') }}">
                        @csrf

                        <!-- Cliente -->
                        <div class="mb-3">
                            <label for="cliente_id" class="form-label font-medium text-sm text-gray-700">Seleccionar Cliente *</label>
                            <select name="cliente_id" id="cliente_id" required class="form-select">
                                <option value="">Seleccione un cliente</option>
                                @foreach ($clientes as $cliente)
                                    <option value="{{ $cliente->id }}"
                                            data-nombre="{{ $cliente->name }}"
                                            data-apellido="{{ $cliente->apellido }}"
                                            data-tipo_documento="{{ $cliente->tipo_documento }}"
                                            data-numero_documento="{{ $cliente->numero_documento }}">
                                        {{ $cliente->name }} ({{ $cliente->numero_documento }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Campos llenados automáticamente -->
                        <div class="row g-3 mb-3">
                            <div class="col-12 col-md-6">
                                <label for="nombre" class="form-label font-medium text-sm text-gray-700">Nombre</label>
                                <input type="text" name="nombre" id="nombre" class="form-control" readonly>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="apellido" class="form-label font-medium text-sm text-gray-700">Apellido</label>
                                <input type="text" name="apellido" id="apellido" class="form-control" readonly>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="tipo_documento" class="form-label font-medium text-sm text-gray-700">Tipo Documento</label>
                                <input type="text" name="tipo_documento" id="tipo_documento" class="form-control" readonly>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="numero_documento" class="form-label font-medium text-sm text-gray-700">Número Documento</label>
                                <input type="text" name="numero_documento" id="numero_documento" class="form-control" readonly>
                            </div>
                        </div>

                        <!-- Tipo de servicio -->
                        <div class="mb-3">
                            <label for="tipo_servicio" class="form-label font-medium text-sm text-gray-700">Tipo de Servicio *</label>
                            <select name="tipo_servicio" id="tipo_servicio" required class="form-select">
                                <option value="">Seleccione un servicio</option>
                                @foreach (['cambio_aceite', 'revision_general', 'mantenimiento_general', 'alineacion', 'frenos', 'suspension', 'electrico'] as $servicio)
                                    <option value="{{ $servicio }}">{{ ucwords(str_replace('_', ' ', $servicio)) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Fecha -->
                        <div class="mb-3">
                            <label for="dia" class="form-label font-medium text-sm text-gray-700">Fecha *</label>
                            <input type="date" name="dia" id="dia" class="form-control"
                                   required min="{{ \Carbon\Carbon::today()->format('Y-m-d') }}">
                        </div>

                        <!-- Hora -->
                        <div class="mb-3">
                            <label for="hora" class="form-label font-medium text-sm text-gray-700">Hora *</label>
                            <input type="time" name="hora" id="hora" class="form-control"
                                   required step="900" min="08:00" max="18:00">
                        </div>

                        <!-- Observaciones -->
                        <div class="mb-4">
                            <label for="observaciones" class="form-label font-medium text-sm text-gray-700">Observaciones</label>
                            <textarea name="observaciones" id="observaciones" rows="3"
                                      class="form-control"></textarea>
                        </div>

                        <!-- Botones -->
                        <div class="row g-2">
                            <div class="col-12 col-md-6">
                                <a href="{{ route('admin.citas.index') }}" class="btn-cancelar w-100 text-center">← Cancelar</a>
                            </div>
                            <div class="col-12 col-md-6">
                                <button type="submit" class="w-100 bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 border-0">
                                    Crear Cita
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('cliente_id').addEventListener('change', function () {
            const selected = this.options[this.selectedIndex];

            document.getElementById('nombre').value = selected.getAttribute('data-nombre') || '';
            document.getElementById('apellido').value = selected.getAttribute('data-apellido') || '';
            document.getElementById('tipo_documento').value = selected.getAttribute('data-tipo_documento') || '';
            document.getElementById('numero_documento').value = selected.getAttribute('data-numero_documento') || '';
        });
    </script>
</x-app-layout>