<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Piston Rojo - Registro</title>
    <link rel="icon" type="image/png" href="{{ asset('imagenes/Logo.png') }}">
    <link rel="stylesheet" href="{{ asset('css/ini_de_sesion.css') }}">
    <style>
        .form-container {
            max-width: 480px;
            margin: 40px auto 0 auto;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.08);
            padding: 2rem 1.5rem;
        }
        
        .logo-img {
            width: 60px;
            height: auto;
        }
        .button-container {
            display: flex;
            gap: 8px;
        }
        .form-content {
            margin-top: 0;
        }
        .login-title {
            font-size: 1.5rem;
            margin-bottom: 30px;
            text-align: center;
        }
        .login-form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px 16px;
        }
        .login-form .form-group {
            margin-bottom: 0;
        }
        .login-form .form-group.full {
            grid-column: 1 / -1;
        }
        .login-label {
            font-size: 0.98rem;
            font-weight: 600;
        }
        .login-input {
            width: 100%;
            padding: 7px 10px;
            font-size: 1rem;
            border-radius: 6px;
            border: 1px solid #bdbdbd;
        }
        .login-input:focus {
            border-color: #e63946;
            outline: none;
        }
        .btn-login-main {
            background: #e63946;
            color: #fff;
            border: none;
            padding: 10px 0;
            border-radius: 6px;
            font-size: 1rem;
            cursor: pointer;
            margin-top: 8px;
            transition: background 0.2s;
            width: 100%;
            grid-column: 1 / -1;
        }
        .btn-login-main:hover {
            background: #b71c1c;
        }
        .login-link-container {
            text-align: center;
            margin-top: 10px;
            grid-column: 1 / -1;
        }
        .underline {
            text-decoration: underline;
            color: #e63946;
            font-size: 0.95rem;
        }
        @media (max-width: 700px) {
            .login-form {
                grid-template-columns: 1fr;
            }
        }
        @media (max-width: 500px) {
            .form-container {
                max-width: 98vw;
                padding: 10px 4vw;
            }
        }
    </style>
</head>
<body>
    <div class="form-container">
        <div class="form-header">
            <a href="{{ url('/') }}">
                <img src="{{ asset('imagenes/Logo.png') }}" alt="Logo" class="logo-img">
            </a>
            <div class="button-container">
                <button id="btn-login" class="btn-login-header" type="button" disabled>Iniciar Sesión</button>
                @if (Route::has('register'))
                    <a id="btn-register" href="{{ route('register') }}" class="btn-register-header">Registrarse</a>
                @endif
            </div>
        </div>
        <div class="form-content active">
            <h2 class="login-title">Registro</h2>
            <form method="POST" action="{{ route('register') }}" class="login-form">
                @csrf

                <div class="form-group">
                    <label for="name" class="login-label">Nombre</label>
                    <input id="name" class="login-input" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                <div class="form-group">
    <label for="apellido" class="login-label">Apellido</label>
    <input id="apellido" class="login-input" type="text" name="apellido" value="{{ old('apellido') }}" required autocomplete="family-name" />
    <x-input-error :messages="$errors->get('apellido')" class="mt-2" />
</div>
                <div class="form-group">
                    <label for="tipo_documento" class="login-label">Tipo de Documento</label>
                    <select id="tipo_documento" name="tipo_documento" required class="login-input">
                        <option value="">Selecciona una opción</option>
                        <option value="CC" {{ old('tipo_documento') == 'CC' ? 'selected' : '' }}>Cédula de Ciudadanía</option>
                        <option value="TI" {{ old('tipo_documento') == 'TI' ? 'selected' : '' }}>Tarjeta de Identidad</option>
                        <option value="CE" {{ old('tipo_documento') == 'CE' ? 'selected' : '' }}>Cédula de Extranjería</option>
                        <option value="NIT" {{ old('tipo_documento') == 'NIT' ? 'selected' : '' }}>NIT</option>
                    </select>
                    <x-input-error :messages="$errors->get('tipo_documento')" class="mt-2" />
                </div>
                <div class="form-group">
                    <label for="numero_documento" class="login-label">Número de Documento</label>
                    <input id="numero_documento" class="login-input" type="text" name="numero_documento" value="{{ old('numero_documento') }}" required />
                    <x-input-error :messages="$errors->get('numero_documento')" class="mt-2" />
                </div>
                <div class="form-group">
                    <label for="fecha_nacimiento" class="login-label">Fecha de Nacimiento</label>
                    <input id="fecha_nacimiento" class="login-input" type="date" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" />
                    <x-input-error :messages="$errors->get('fecha_nacimiento')" class="mt-2" />
                </div>
                <div class="form-group">
                    <label for="telefono" class="login-label">Teléfono</label>
                    <input id="telefono" class="login-input" type="text" name="telefono" value="{{ old('telefono') }}" required />
                    <x-input-error :messages="$errors->get('telefono')" class="mt-2" />
                </div>
                <div class="form-group">
                    <label for="email" class="login-label">Email</label>
                    <input id="email" class="login-input" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <div class="form-group">
                    <label for="password" class="login-label">Contraseña</label>
                    <input id="password" class="login-input" type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <div class="form-group">
                    <label for="password_confirmation" class="login-label">Confirmar Contraseña</label>
                    <input id="password_confirmation" class="login-input" type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
                <button class="btn-login-main" type="submit">
                    Registrarse
                </button>
                <div class="login-link-container">
                    <a class="underline" href="{{ route('login') }}">
                        ¿Ya tienes cuenta?
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>