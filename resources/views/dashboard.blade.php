<x-app-layout>
    @push('head')
    <style>
        /* Fuerza fondo negro y texto blanco en cualquier elemento con fondo blanco de Bootstrap */
        .dashboard-bg,
        .dashboard-bg.bg-white,
        .dashboard-bg[class*="bg-white"],
        .dashboard-bg[style*="--bs-white-rgb"],
        .dashboard-bg[style*="background-color"] {
            background: #181818 !important;
            background-color: #181818 !important;
            color: #fff !important;
        }
        /* También para el header */
        header,
        header > div,
        header .bg-white,
        header[class*="bg-white"],
        header[style*="--bs-white-rgb"],
        header[style*="background-color"] {
            background: #181818 !important;
            background-color: #181818 !important;
            color: #fff !important;
        }
    </style>
    @endpush

    <x-slot name="header">
        <div style="background: #181818 !important; padding: 1rem 0; border-radius: 8px; color: #fff !important;">
            <h2 class="font-semibold text-xl" style="color: #fff; margin: 0;">
                {{ __('Instrucciones') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="dashboard-bg overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    {{ __("¡Has iniciado sesión!") }}
                    <br><br>
                    <span>
                        Por motivos de seguridad y para completar correctamente el proceso de registro, por favor dirígete al panel superior donde aparece tu usuario o cliente, selecciona la opción <b>"Cerrar sesión"</b> y luego vuelve a ingresar desde la página de inicio de sesión.<br><br>
                        Así garantizarás el acceso adecuado a todas las funcionalidades del sistema.<br><br>
                        <b>Recuerda:</b> Cuando termines de realizar tus gestiones en esta página, por favor no olvides cerrar sesión nuevamente para proteger tu cuenta y tu información.
                    </span>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>