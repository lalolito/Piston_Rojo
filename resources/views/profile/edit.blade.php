<x-app-layout>
    @push('head')
        <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    @endpush

    <section class="profile-container">
        <h2>Información del Perfil</h2>
        <p>Actualiza tu información personal.</p>

        <form method="post" action="{{ route('profile.update') }}">
            @csrf
            @method('patch')

            <div>
                <label for="name">Nombre</label>
                <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}" required>
                @error('name') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div>
                <label for="apellido">Apellido</label>
                <input id="apellido" type="text" name="apellido" value="{{ old('apellido', $user->apellido) }}" required>
                @error('apellido') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div>
                <label for="tipo_documento">Tipo de Documento</label>
                <select id="tipo_documento" name="tipo_documento" required>
                    <option value="CC" @selected(old('tipo_documento', $user->tipo_documento) == 'CC')>Cédula de Ciudadanía</option>
                    <option value="TI" @selected(old('tipo_documento', $user->tipo_documento) == 'TI')>Tarjeta de Identidad</option>
                    <option value="CE" @selected(old('tipo_documento', $user->tipo_documento) == 'CE')>Cédula de Extranjería</option>
                    <option value="NIT" @selected(old('tipo_documento', $user->tipo_documento) == 'NIT')>NIT</option>
                </select>
                @error('tipo_documento') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div>
                <label for="numero_documento">Número de Documento</label>
                <input id="numero_documento" type="text" name="numero_documento" value="{{ old('numero_documento', $user->numero_documento) }}" required>
                @error('numero_documento') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div>
                <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                <input id="fecha_nacimiento" type="date" name="fecha_nacimiento" value="{{ old('fecha_nacimiento', $user->fecha_nacimiento) }}">
                @error('fecha_nacimiento') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div>
                <label for="telefono">Teléfono</label>
                <input id="telefono" type="text" name="telefono" value="{{ old('telefono', $user->telefono) }}" required>
                @error('telefono') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div>
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}" required>
                @error('email') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="button-group">
                <button type="submit">Guardar cambios</button>
                @if (Auth::user()->role === 'admin')
                    <a href="{{ route('admin.inicio') }}" class="back-button">Regresar</a>
                @else
                    <a href="{{ route('cliente.inicio') }}" class="back-button">Regresar</a>
                @endif
                @if (session('status') === 'profile-updated')
                    <p class="status-message">Guardado.</p>
                @endif
            </div>
        </form>
    </section>
</x-app-layout>