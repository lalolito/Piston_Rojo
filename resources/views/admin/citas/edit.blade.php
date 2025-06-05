<x-app-layout>
    @push('head')
        <link rel="stylesheet" href="{{ asset('css/citasedit.css') }}">
    @endpush
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8 col-xl-7">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">Editar Cita</h2>

                @if ($errors->any())
                    <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.citas.update', $cita->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <!-- Nombre -->
                        <div class="col-12 col-md-6">
                            <label for="nombre" class="form-label font-medium text-sm text-gray-700">Nombre *</label>
                            <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $cita->nombre) }}"
                                   required class="form-control">
                        </div>

                        <!-- Apellido -->
                        <div class="col-12 col-md-6">
                            <label for="apellido" class="form-label font-medium text-sm text-gray-700">Apellido *</label>
                            <input type="text" name="apellido" id="apellido" value="{{ old('apellido', $cita->apellido) }}"
                                   required class="form-control">
                        </div>

                        <!-- Tipo de Documento -->
                        <div class="col-12 col-md-6">
                            <label for="tipo_documento" class="form-label font-medium text-sm text-gray-700">Tipo de Documento *</label>
                            <select name="tipo_documento" id="tipo_documento" required class="form-select">
                                @foreach (['cc' => 'Cédula de ciudadanía', 'ti' => 'Tarjeta de identidad', 'cxe' => 'Cédula de extranjería', 'pasaporte' => 'Pasaporte'] as $valor => $texto)
                                    <option value="{{ $valor }}" {{ old('tipo_documento', $cita->tipo_documento) === $valor ? 'selected' : '' }}>
                                        {{ $texto }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Número de Documento -->
                        <div class="col-12 col-md-6">
                            <label for="numero_documento" class="form-label font-medium text-sm text-gray-700">Número de Documento *</label>
                            <input type="text" name="numero_documento" id="numero_documento" value="{{ old('numero_documento', $cita->numero_documento) }}"
                                   required class="form-control">
                        </div>

                        <!-- Tipo de Servicio -->
                        <div class="col-12">
                            <label for="tipo_servicio" class="form-label font-medium text-sm text-gray-700">Tipo de Servicio *</label>
                            <select name="tipo_servicio" id="tipo_servicio" required class="form-select">
                                @foreach (['cambio_aceite', 'revision_general', 'mantenimiento_general', 'alineacion', 'frenos', 'suspension', 'electrico'] as $servicio)
                                    <option value="{{ $servicio }}" {{ old('tipo_servicio', $cita->tipo_servicio) === $servicio ? 'selected' : '' }}>
                                        {{ ucwords(str_replace('_', ' ', $servicio)) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Fecha -->
                        <div class="col-12 col-md-6">
                            <label for="dia" class="form-label font-medium text-sm text-gray-700">Fecha *</label>
                            <input type="date" name="dia" id="dia" value="{{ old('dia', \Carbon\Carbon::parse($cita->dia)->format('Y-m-d')) }}"
                                   required class="form-control"
                                   min="{{ \Carbon\Carbon::today()->format('Y-m-d') }}">
                        </div>

                        <!-- Hora -->
                        <div class="col-12 col-md-6">
                            <label for="hora" class="form-label font-medium text-sm text-gray-700">Hora *</label>
                            <input type="time" name="hora" id="hora" value="{{ old('hora', $cita->hora) }}"
                                   required step="900" min="08:00" max="18:00"
                                   class="form-control">
                            <p class="text-sm text-gray-500 mt-1">Entre 08:00 y 18:00. Intervalos de 15 minutos.</p>
                        </div>

                        <!-- Estado -->
                        <div class="col-12 col-md-6">
                            <label for="estado" class="form-label font-medium text-sm text-gray-700">Estado de la Cita</label>
                            <select name="estado" id="estado" class="form-select">
                                @foreach (['pendiente', 'confirmada', 'completada', 'cancelada', 'no_asistio'] as $estado)
                                    <option value="{{ $estado }}" {{ old('estado', $cita->estado) === $estado ? 'selected' : '' }}>
                                        {{ ucfirst($estado) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Observaciones -->
                    <div class="mt-4">
                        <label for="observaciones" class="form-label font-medium text-sm text-gray-700">Observaciones</label>
                        <textarea name="observaciones" id="observaciones" rows="3"
                                  class="form-control">{{ old('observaciones', $cita->observaciones) }}</textarea>
                    </div>

                    <!-- Botones -->
                    <div class="row mt-4 g-2">
                        <div class="col-12 col-md-6">
                            <a href="{{ route('admin.citas.index') }}" class="btn-cancelar w-100 text-center">← Cancelar</a>
                        </div>
                        <div class="col-12 col-md-6">
                            <button type="submit" class="w-100 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-md border-0">
                                Guardar Cambios
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>