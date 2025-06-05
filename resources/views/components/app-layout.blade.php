<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Piston Rojo</title>
    <!-- Tus links y scripts aquí -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="{{ asset('css/estilosjv.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('imagenes/Logo.png') }}">
    @stack('head')
</head>
<body>
    <!-- Aquí puedes poner tu header si quieres -->
    <header>
        <h1 class="logo">Piston Rojo</h1>
    </header>
    {{ $slot }}
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    @stack('scripts')
</body>
</html>