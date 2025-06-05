<x-app-layout>
    @push('head')
        <link rel="stylesheet" href="{{ asset('css/citasiniciousu.css') }}">
    @endpush

    <div class="cliente-hero position-relative">
        <div class="cliente-hero-overlay"></div>
        <div class="cliente-hero-content container d-flex flex-column align-items-center justify-content-center text-center py-5">
            <img src="{{ asset('imagenes/Logo.png') }}" alt="Logo Piston Rojo" class="cliente-logo-hero mb-3 img-fluid" style="max-width:180px;">
            <h1 class="display-5 fw-bold mb-3 text-break">¡Bienvenido a Piston Rojo!</h1>
            <p class="lead mb-4">Gestiona tus citas, conoce nuestros servicios y descubre todos los beneficios que tenemos para ti y tu moto.</p>
            <div class="d-flex justify-content-center">
                <a href="{{ route('cliente.citas.create') }}" class="btn-agendar-cita grande btn btn-primary btn-lg px-4 py-2 w-100 w-md-auto">
                    Agenda tu cita ahora
                </a>
            </div>
        </div>
    </div>

    <div class="cliente-secciones container my-5">
        <div class="row g-4">
            <div class="col-12 col-md-4 d-flex">
                <div class="cliente-card animar h-100 d-flex flex-column w-100">
                    <img src="{{ asset('imagenes/mantenimiento1.avif') }}" alt="Servicio Moto" class="cliente-card-img img-fluid rounded-top">
                    <div class="flex-grow-1 d-flex flex-column justify-content-between p-3">
                        <div>
                            <h2 class="h5 fw-bold mb-2">Servicios Premium</h2>
                            <ul class="mb-2 ps-3">
                                <li>✔ Ajustes precisos en el motor</li>
                                <li>✔ Revisión de suspensión y frenos</li>
                                <li>✔ Optimización de transmisión</li>
                                <li>✔ Diagnóstico electrónico avanzado</li>
                            </ul>
                        </div>
                        <p class="mb-0">¡Tu moto en manos expertas, lista para cualquier aventura!</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 d-flex">
                <div class="cliente-card animar h-100 d-flex flex-column w-100">
                    <img src="{{ asset('imagenes/K1.avif') }}" alt="Beneficios" class="cliente-card-img img-fluid rounded-top">
                    <div class="flex-grow-1 d-flex flex-column justify-content-between p-3">
                        <div>
                            <h2 class="h5 fw-bold mb-2">Beneficios Exclusivos</h2>
                            <ul class="mb-2 ps-3">
                                <li>🚀 Más potencia y eficiencia</li>
                                <li>🛡️ Seguridad y garantía</li>
                                <li>🔧 Mantenimiento preventivo</li>
                                <li>🏍️ Experiencia de conducción superior</li>
                            </ul>
                        </div>
                        <p class="mb-0">¡Vive la diferencia Piston Rojo!</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 d-flex">
                <div class="cliente-card animar h-100 d-flex flex-column w-100">
                    <img src="{{ asset('imagenes/bg4.jpg') }}" alt="Testimonios" class="cliente-card-img img-fluid rounded-top">
                    <div class="flex-grow-1 d-flex flex-column justify-content-between p-3">
                        <div>
                            <h2 class="h5 fw-bold mb-2">Testimonios de Clientes</h2>
                            <ul class="mb-2 ps-3">
                                <li>
                                    <strong>Juan P.</strong>: <em>"Excelente servicio, mi moto quedó como nueva y el trato fue espectacular."</em>
                                </li>
                                <li>
                                    <strong>Laura G.</strong>: <em>"¡Recomendado! Rápidos, confiables y muy profesionales."</em>
                                </li>
                                <li>
                                    <strong>Carlos M.</strong>: <em>"La mejor experiencia en talleres, volveré sin dudarlo."</em>
                                </li>
                            </ul>
                        </div>
                        <p class="mb-0">¡Gracias por confiar en nosotros!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="info-box container mb-5">
        <h2 class="h4 fw-bold mb-3 text-center text-md-start">¿Dónde estamos?</h2>
        <div class="map-container mb-3 rounded overflow-hidden" style="height: 250px;">
            <iframe
                width="100%" height="100%" frameborder="0" style="border:0"
                src="https://www.google.com/maps?q=4.486197,-74.101221&z=19&output=embed"
                allowfullscreen>
            </iframe>
        </div>
        <div class="contacto-box row g-2">
            <div class="contacto-item col-12 col-md-6 text-center text-md-start">
                <span>Calle 109 sur # 7 este 14, Bogotá, Colombia</span>
            </div>
            <div class="contacto-item col-12 col-md-6 text-center text-md-end">
                <span>Contáctanos: <a href="tel:+573053055073" class="cliente-link">+57 3053055073</a></span>
            </div>
        </div>
    </div>

    <div class="cliente-footer py-3">
        <div class="container d-flex flex-column flex-md-row align-items-center justify-content-between">
            <div class="cliente-footer-text mb-2 mb-md-0 text-center text-md-start">
                <span>¡Síguenos y mantente informado!</span>
            </div>
            <div class="redes-sociales d-flex gap-3 justify-content-center justify-content-md-end">
                <a href="https://www.facebook.com/miltonjulio.vargasgonzalez" target="_blank">
                    <img src="{{ asset('imagenes/facebook.png') }}" alt="Facebook" style="width:32px; height:32px;">
                </a>
                <a href="https://wa.me/573053055073" target="_blank">
                    <img src="{{ asset('imagenes/whatsap.jpg') }}" alt="WhatsApp" style="width:32px; height:32px;">
                </a>
            </div>
        </div>
    </div>
</x-app-layout>