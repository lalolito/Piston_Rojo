<x-app-layout>
    @push('head')
        <link rel="stylesheet" href="{{ asset('css/estilosjv.css') }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @endpush

    <div class="wrapper">
        <!-- Menú móvil fijo abajo y centrado -->
        <nav class="mobile-nav">
            <ul>
                <li>
                    <a href="{{ route('admin.inventario.index') }}" class="boton-menu{{ request()->routeIs('admin.inventario.*') ? ' active' : '' }}">
                        <i class="bi bi-list-ul"></i>
                        <span>Productos</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.citas.index') }}" class="boton-menu{{ request()->routeIs('admin.citas.*') ? ' active' : '' }}">
                        <i class="bi bi-calendar"></i>
                        <span>Citas</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.proveedores.index') }}" class="boton-menu{{ request()->routeIs('admin.proveedores.*') ? ' active' : '' }}">
                        <i class="bi bi-building-fill"></i>
                        <span>Proveedores</span>
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Sidebar SOLO en escritorio o cuando está abierto en móvil -->
        <aside id="sidebar">
            <div class="sidebar-header">
                <a href="{{ url('/') }}">
                    <img class="dv" src="{{ asset('imagenes/Logo.png') }}" alt="Piston Rojo Logo">
                </a>
                <span class="sidebar-title">Piston Rojo</span>
                <button class="close-menu" id="close-menu" aria-label="Cerrar menú">
                    <i class="bi bi-x"></i>
                </button>
            </div>
            <nav>
                <ul class="menu">
                    <li>
                        <a href="{{ route('admin.inventario.index') }}" class="boton-menu{{ request()->routeIs('admin.inventario.*') ? ' active' : '' }}">
                            <i class="bi bi-list-ul"></i> Productos
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.citas.index') }}" class="boton-menu{{ request()->routeIs('admin.citas.*') ? ' active' : '' }}">
                            <i class="bi bi-calendar"></i> Citas
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.proveedores.index') }}" class="boton-menu{{ request()->routeIs('admin.proveedores.*') ? ' active' : '' }}">
                            <i class="bi bi-building-fill"></i> Proveedores
                        </a>
                    </li>
                </ul>
            </nav>
            <footer>
                <p class="texto-footer">© 2024 Piston Rojo</p>
            </footer>
        </aside>

        <!-- Main content -->
        <main class="main-content">
            <h2 class="titulo-principal">Bienvenido Administrador</h2>
            <div class="dashboard-card">
                <div class="dashboard-card-icon">
                    <i class="bi bi-speedometer2"></i>
                </div>
                <div class="dashboard-card-content">
                    <h3>Panel de Control</h3>
                    <p>
                        Gestiona productos, citas y proveedores desde un solo lugar.<br>
                        Usa el menú lateral o la barra inferior para navegar.<br>
                        <span class="dashboard-tip"><i class="bi bi-lightbulb"></i> Consejo:</span> ¡Mantén tu inventario y agenda siempre actualizados para un mejor servicio!
                    </p>
                </div>
            </div>
            <div class="dashboard-card">
                <div class="dashboard-card-icon" style="background: linear-gradient(135deg, #007bff 60%, #181818 100%);">
                    <i class="bi bi-box-seam"></i>
                </div>
                <div class="dashboard-card-content">
                    <h3>Gestión de Inventario</h3>
                    <p>
                        Revisa y actualiza tu inventario regularmente.<br>
                        <span class="dashboard-tip"><i class="bi bi-lightbulb"></i> Consejo:</span> Un inventario actualizado evita faltantes y mejora la atención al cliente.
                    </p>
                </div>
            </div>
            <div class="dashboard-card">
                <div class="dashboard-card-icon" style="background: linear-gradient(135deg, #28a745 60%, #181818 100%);">
                    <i class="bi bi-calendar-check"></i>
                </div>
                <div class="dashboard-card-content">
                    <h3>Agenda de Citas</h3>
                    <p>
                        Organiza tus citas y confirma la asistencia de tus clientes.<br>
                        <span class="dashboard-tip"><i class="bi bi-lightbulb"></i> Consejo:</span> Notifica a tus clientes para reducir ausencias y mejorar la planificación.
                    </p>
                </div>
            </div>
            <div class="dashboard-card">
                <div class="dashboard-card-icon" style="background: linear-gradient(135deg, #ffc107 60%, #181818 100%);">
                    <i class="bi bi-people-fill"></i>
                </div>
                <div class="dashboard-card-content">
                    <h3>Relación con Proveedores</h3>
                    <p>
                        Mantén una comunicación fluida con tus proveedores.<br>
                        <span class="dashboard-tip"><i class="bi bi-lightbulb"></i> Consejo:</span> Negocia mejores condiciones y asegura entregas a tiempo para tu negocio.
                    </p>
                </div>
            </div>
            <div id="contenedor-productos" class="contenedor-productos">
                <!-- Aquí va el contenido dinámico de productos -->
            </div>
        </main>
    </div>
</x-app-layout>