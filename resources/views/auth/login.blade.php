
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Piston Rojo - Registro e Inicio de Sesión</title>
    <link rel="icon" type="image/png" href="{{ asset('imagenes/Logo.png') }}">
    <link rel="stylesheet" href="{{ asset('css/ini_de_sesion.css') }}">
    <script type="module">
    // Configuración de Firebase
    const firebaseConfig = {
        apiKey: "AIzaSyDS8drfHS60JeoX43BiKhexUfJzN5KMTg0",
        authDomain: "pistonrojo.firebaseapp.com",
        projectId: "pistonrojo",
        storageBucket: "pistonrojo.firebasestorage.app",
        messagingSenderId: "857832425258",
        appId: "1:857832425258:web:ea927026ff1b5ac56c8053",
        measurementId: "G-RBLRWE30M2"
    };

    // Importar Firebase
    import { initializeApp } from "https://www.gstatic.com/firebasejs/9.17.1/firebase-app.js";
    import { getAuth, GoogleAuthProvider, signInWithPopup } from "https://www.gstatic.com/firebasejs/9.17.1/firebase-auth.js";

    // Inicializar Firebase
    const app = initializeApp(firebaseConfig);

    // Obtener la referencia de autenticación
    const auth = getAuth(app);
    const googleProvider = new GoogleAuthProvider();

    // Función para iniciar sesión con Google
    function googleLogin() {
        signInWithPopup(auth, googleProvider)
        .then(result => {
            const credential = GoogleAuthProvider.credentialFromResult(result);
            const googleIdToken = credential.idToken;
            // Enviar el token al backend
            fetch('/google-login', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: JSON.stringify({ token: googleIdToken })
            })
            .then(response => response.json())
            .then(data => {
            if (data.success && data.redirect) {
                window.location.href = data.redirect;
            } else {
                alert('No se pudo iniciar sesión con Google.');
            }
            });
        })
        .catch(error => {
            alert('Error al iniciar sesión con Google.');
        });
    }
    window.googleLogin = googleLogin;
    </script>
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

        <div id="login" class="form-content active">
            <h2 class="login-title">Iniciar Sesión</h2>
            <form method="POST" action="{{ route('login') }}" class="login-form">
                @csrf
                <div class="form-group">
                    <label for="loginEmail" class="login-label">Email:</label>
                    <input type="email" id="loginEmail" name="email" class="login-input" placeholder="Correo electrónico" required value="{{ old('email') }}">
                </div>
                <div class="form-group">
                    <label for="loginPassword" class="login-label">Contraseña:</label>
                    <input type="password" id="loginPassword" name="password" class="login-input" placeholder="Contraseña" required>
                </div>
                <div class="form-group remember-group">
                    <label class="remember-label">
                        <input type="checkbox" name="remember" class="remember-checkbox">
                        Recordarme
                    </label>
                </div>
                <button type="submit" class="btn-login-main">Iniciar Sesión</button>
            </form>
            <button type="button" class="btn-google-login" onclick="googleLogin()">Iniciar sesión con Google</button>
            
        </div>
    </div>
</body>
</html>