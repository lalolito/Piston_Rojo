<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Piston Rojo</title>
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('imagenes/Logo.png') }}">
    @vite(['resources/js/app.js'])
    <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB5ISopW55GkEx6mAxJmesnHm3pF-Crx78&callback=console.debug&libraries=maps,marker&v=beta"></script>
</head>
<body class="body">

    <nav class="navbar navbar-expand-md navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('imagenes/Logo.png') }}" alt="Piston Rojo" class="d-inline-block align-text-top" style="max-height: 40px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="#sobre-nosotros">Sobre Nosotros</a></li>
                    <li class="nav-item"><a class="nav-link" href="#Servicios">Servicios</a></li>
                    <li class="nav-item"><a class="nav-link" href="#Conócenos">Conócenos</a></li>
                </ul>
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Iniciar sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Carrusel -->
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('imagenes/mecanica-motos.jpg') }}" class="d-block w-100" alt="Reparación de motocicleta 1">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Reparaciones de Motocicletas de Alta Calidad</h5>
                    <p>Confía en nosotros para mantener tu moto en las mejores condiciones. ¡Servicio rápido y confiable!</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('imagenes/Carrusel-2.jpg') }}" class="d-block w-100" alt="Reparación de motocicleta 2">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Expertos en Mantenimiento de Motocicletas</h5>
                    <p>Desde cambios de aceite hasta revisiones completas, ¡somos tu mejor opción para cuidar tu moto!</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('imagenes/Carrusel-3.webp') }}" class="d-block w-100" alt="Reparación de motocicleta 3">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Tu Moto en Manos Seguras</h5>
                    <p>Nos especializamos en la reparación y mantenimiento profesional de motocicletas para un rendimiento óptimo.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Siguiente</span>
        </button>
    </div>
    <!-- Fin Carrusel -->

    <!-- Servicios -->
    <div class="container my-5" id="Servicios">
        <div class="text-center">
            <h2>Algunos de Nuestros Servicios</h2>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-4 col-12 mb-4">
                <div class="card h-100 mx-auto" style="max-width: 18rem;">
                    <img src="{{ asset('imagenes/mantenimiento1.avif') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Revisión General</h5>
                        <p class="card-text">Revisión completa del estado mecánico de la moto, incluyendo motor, transmisión, frenos, suspensión, sistema eléctrico y neumáticos.</p>
                        <a href="{{ route('login') }}" class="btn btn-primary">Ver más</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-12 mb-4">
                <div class="card h-100 mx-auto" style="max-width: 18rem;">
                    <img src="{{ asset('imagenes/mantenimiento2.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Revisión Sistema Eléctrico</h5>
                        <p class="card-text">Verificación del correcto funcionamiento del sistema eléctrico, incluyendo batería, luces, indicadores y cableado.</p>
                        <a href="{{ route('login') }}" class="btn btn-primary">Ver más</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-12 mb-4">
                <div class="card h-100 mx-auto" style="max-width: 18rem;">
                    <img src="{{ asset('imagenes/mantenimiento3.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Revisión Cadena de Transmisión</h5>
                        <p class="card-text">Inspección y ajuste de la tensión de la cadena de transmisión, asegurando una transmisión de potencia eficiente.</p>
                        <a href="{{ route('login') }}" class="btn btn-primary">Ver más</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin Servicios -->

    <!-- Sobre Nosotros -->
    <div class="main" style="background-color: #000; color: #fff; padding: 60px 20px;">
        <div class="content" id="sobre-nosotros"></div>
        <div class="container">
            <div class="text-center mb-5">
                <h1 style="font-family: 'Playfair Display', serif; font-size: 3rem; color: #ff0000; text-transform: uppercase; letter-spacing: 4px;">
                    Sobre Nosotros</h1>
                <p style="font-size: 1.2rem; color: #ddd; max-width: 800px; margin: 0 auto; line-height: 1.6;">
                    Somos una microempresa dedicada al mantenimiento y reparación de motocicletas en la localidad de El Uval, 5ta de Usme. Nos especializamos en brindar un servicio integral y personalizado para todo tipo de motos, asegurando la mejor calidad y atención para que tu vehículo esté siempre en óptimas condiciones.
                </p>
            </div>
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card h-100" style="background-color: #222; border: none; border-radius: 12px; overflow: hidden; box-shadow: 0 8px 16px rgba(0, 0, 0, 0.5);">
                        <img src="{{ asset('imagenes/imagen-mantenimiento.avif') }}" alt="Imagen de mantenimiento" style="width: 100%; height: 250px; object-fit: cover;">
                        <div class="card-body text-center">
                            <h3 style="color: #ff0000; margin-top: 20px;">Mantenimiento</h3>
                            <p style="color: #ddd;">Aseguramos que tu moto esté siempre en perfectas condiciones con un mantenimiento integral y profesional.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card h-100" style="background-color: #222; border: none; border-radius: 12px; overflow: hidden; box-shadow: 0 8px 16px rgba(0, 0, 0, 0.5);">
                        <img src="{{ asset('imagenes/imagen-reparacion.webp') }}" alt="Imagen de reparación" style="width: 100%; height: 250px; object-fit: cover;">
                        <div class="card-body text-center">
                            <h3 style="color: #ff0000; margin-top: 20px;">Reparación</h3>
                            <p style="color: #ddd;">Nuestro equipo de expertos se encarga de reparar cualquier problema de manera rápida y efectiva.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin Sobre Nosotros -->

    <!-- Conócenos -->
    <div class="container-fluid py-5" style="background-color: #000000;">
        <div class="content" id="Conócenos"></div>
        <div class="text-center mb-5">
            <h2 style="font-size: 2.5rem; color: #fff; font-weight: bold;">Conócenos</h2>
            <p style="color: #bbb; font-size: 1.2rem;">Descubre quiénes somos y qué nos motiva.</p>
        </div>
        <div class="row">
            <div class="col-md-3 col-12 mb-4">
                <div class="card h-100" style="background-color: #222; border: none;">
                    <img src="{{ asset('imagenes/Conosenos_1.webp') }}" class="card-img-top rounded-top" alt="Nuestra Historia" style="height: 200px; object-fit: cover;">
                    <div class="card-body text-center">
                        <h3 class="card-title" style="color: #ff0000;">Nuestra Historia</h3>
                        <p class="card-text" style="color: #ddd;">En "El Pistón Rojo", nuestra historia es un testimonio de compromiso y dedicación. Nos hemos esforzado por ofrecer un servicio de alta calidad.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-12 mb-4">
                <div class="card h-100" style="background-color: #222; border: none;">
                    <img src="{{ asset('imagenes/Conosenos_2.jpg') }}" class="card-img-top rounded-top" alt="Nuestra Misión" style="height: 200px; object-fit: cover;">
                    <div class="card-body text-center">
                        <h3 class="card-title" style="color: #ff0000;">Nuestra Misión</h3>
                        <p class="card-text" style="color: #ddd;">Nos dedicamos a proporcionar un servicio excepcional en el mantenimiento y reparación de motocicletas, garantizando la satisfacción del cliente.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-12 mb-4">
                <div class="card h-100" style="background-color: #222; border: none;">
                    <img src="{{ asset('imagenes/Conosenos_3.jpg') }}" class="card-img-top rounded-top" alt="Nuestra Visión" style="height: 200px; object-fit: cover;">
                    <div class="card-body text-center">
                        <h3 class="card-title" style="color: #ff0000;">Nuestra Visión</h3>
                        <p class="card-text" style="color: #ddd;">Aspiramos a ser el taller de referencia en nuestra área, destacándonos por la eficiencia y la calidad en nuestro trabajo.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-12 mb-4">
                <div class="card h-100" style="background-color: #222; border: none;">
                    <img src="{{ asset('imagenes/Conosenos_4.jpg') }}" class="card-img-top rounded-top" alt="Nuestros Valores" style="height: 200px; object-fit: cover;">
                    <div class="card-body text-center">
                        <h3 class="card-title" style="color: #ff0000;">Nuestros Valores</h3>
                        <p class="card-text" style="color: #ddd;">La integridad, el compromiso y la excelencia son los pilares de nuestro servicio. Creemos en la importancia del trabajo en equipo.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mapa -->
    <div class="elementor-1240 elementor-element elementor-element-9ac4d4f"
        style="width: 100%; max-width: 800px; height: 400px; margin: 20px auto; display: flex; justify-content: center; align-items: center;">
        <gmp-map center="4.486197,-74.101221" zoom="19" map-id="DEMO_MAP_ID" style="width: 100%; height: 100%;">
            <gmp-advanced-marker position="4.486197,-74.101221" title="Cl. 114b Sur #7f Este-1"></gmp-advanced-marker>
        </gmp-map>
    </div>

    <footer class="footer bg-white text-dark text-center py-4 mt-5 w-100" style="box-shadow: 0 -2px 8px rgba(0,0,0,0.05);">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12 col-md-4 mb-3 mb-md-0">
                    <p class="mb-1">Contáctenos: +57 3053055073</p>
                    <p class="mb-0">Ubicación: Calle 109 sur # 7 este 14, Bogotá, Colombia</p>
                </div>
                <div class="col-12 col-md-4 mb-3 mb-md-0">
                    <p class="mb-1"><a href="#" class="text-dark text-decoration-none">Política Tratamiento de datos</a></p>
                    <p class="mb-0"><a href="#" class="text-dark text-decoration-none">Repositorio de motos</a></p>
                </div>
                <div class="col-12 col-md-4">
                    <a href="https://www.facebook.com/miltonjulio.vargasgonzalez" target="_blank" class="mx-2">
                        <img src="{{ asset('imagenes/facebook.png') }}" alt="Facebook" style="width:32px;">
                    </a>
                    <a href="https://www.whatsapp.com/" target="_blank" class="mx-2">
                        <img src="{{ asset('imagenes/whatsap.jpg') }}" alt="Whatsapp" style="width:32px;">
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <script src="{{ asset('assets/js/T-Titule.js') }}"></script>
</body>
</html>