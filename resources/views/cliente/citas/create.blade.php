<x-app-layout> 

@push('head')
    <link rel="stylesheet" href="{{ asset('css/citascreateusu.css') }}">
@endpush

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            <div class="cita-form-container bg-white shadow rounded p-4">
                <h2 class="cita-form-title text-center mb-4">Agendar Nueva Cita</h2>

                @if ($errors->any())
                    <div class="cita-error-box alert alert-danger">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('cliente.citas.store') }}">
                    @csrf

                    <!-- Servicio -->
                    <div class="cita-form-group mb-3">
                        <label for="tipo_servicio" class="form-label">Tipo de Servicio *</label>
                        <select name="tipo_servicio" id="tipo_servicio" required class="form-select">
                            <option value="">Selecciona un servicio</option>
                            @foreach(['cambio_aceite', 'revision_general', 'mantenimiento_general', 'alineacion', 'frenos', 'suspension', 'electrico'] as $servicio)
                                <option value="{{ $servicio }}" {{ old('tipo_servicio') == $servicio ? 'selected' : '' }}>
                                    {{ ucwords(str_replace('_', ' ', $servicio)) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Día -->
                    <div class="cita-form-group mb-3">
                        <label for="dia" class="form-label">Fecha *</label>
                        <input type="date" name="dia" id="dia" value="{{ old('dia') }}"
                               required min="{{ \Carbon\Carbon::today()->format('Y-m-d') }}" class="form-control">
                    </div>

                    <!-- Hora -->
                    <div class="cita-form-group mb-3">
                        <label for="hora" class="form-label">Hora *</label>
                        <input type="time" name="hora" id="hora" value="{{ old('hora') }}"
                               required step="900" min="08:00" max="18:00" class="form-control">
                        <small class="cita-help-text text-muted">Disponible entre 08:00 y 18:00. Intervalos de 15 minutos.</small>
                    </div>

                    <!-- Observaciones -->
                    <div class="cita-form-group mb-4">
                        <label for="observaciones" class="form-label">Observaciones</label>
                        <textarea name="observaciones" id="observaciones" rows="3" class="form-control">{{ old('observaciones') }}</textarea>
                    </div>

                    <!-- Botones -->
                    <div class="cita-form-actions d-flex flex-column flex-md-row gap-2 mt-4">
                        <a href="{{ route('cliente.citas.index') }}" class="cita-link-volver w-100 text-center">
                            ← Ver Mis Citas
                        </a>
                        <button type="submit" class="cita-btn-submit w-100">
                            Agendar Cita
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</x-app-layout>