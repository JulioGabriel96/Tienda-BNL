<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Tienda BNL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #1a3a52;
            --primary-dark: #0f2438;
            --secondary-color: #00d4ff;
            --accent-color: #ff6b6b;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --dark: #1f2937;
            --light: #f9fafb;
            --sidebar-width: 280px;
            --sidebar-width-collapsed: 80px;
            --transition-speed: 0.3s;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            height: 100%;Inter', 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            color: var(--dark);
            display: flex;
            min-height: 100vh
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            color: #2c3e50;
            display: flex;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            width: var(--sidebar-width);80deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: white;
            padding: 0;
            z-index: 1000;
            overflow-y: auto;
            transition: width var(--transition-speed) ease;
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.15) ease;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        }

        .sidebar.collapsed {
            width: var(--sidebar-width-collapsed);
        }

        .sidebar-header {
            padding: 1.5rem 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
            min-height: 80px;
        }

        .sidebar-brand {
            font-weight: 700;
            font-size: 1.3rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all var(--transition-speed) ease;
            white-space: nowrap;
        }

        .sidebar.collapsed .sidebar-brand span {
            display: none;
        }

        .toggle-sidebar {
            background: none;
            border: none;
            color: white;
            cursor: pointer;
            font-size: 1.3rem;
            transition: all var(--transition-speed) ease;
            padding: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .toggle-sidebar:hover {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 6px;
        }

        .sidebar-menu {
            list-style: none;
            padding: 1rem 0;
        }

        .sidebar-menu li {
            margin: 0;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all var(--transition-speed) ease;
            cursor: pointer;
            border-left: 3px solid transparent;
            font-weight: 500;
        }

        .menu-item:hover {0, 212, 255, 0.1);
            color: white;
            border-left-color: var(--secondary-color);
        }

        .menu-item.active {
            background: rgba(0, 212, 255, 0.15
            background: rgba(52, 152, 219, 0.2);
            color: white;
            border-left-color: var(--secondary-color);
        }

        .menu-item i {
            font-size: 1.2rem;
            min-width: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .menu-item-label {
            margin-left: 0.75rem;
            flex: 1;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .sidebar.collapsed .menu-item-label {
            display: none;
        }

        .submenu-toggle {
            margin-left: auto;
            transition: transform var(--transition-speed) ease;
            font-size: 0.9rem;
        }

        .menu-item.has-submenu.collapsed .submenu-toggle {
            transform: rotate(-90deg);
        }

        .submenu {
            list-style: none;
            padding: 0;
            background: rgba(0, 0, 0, 0.2);
            max-height: 500px;
            overflow: hidden;
            transition: max-height var(--transition-speed) ease;
        }

        .submenu.collapsed {
            max-height: 0;
        }

        .submenu li {
            margin: 0;
        }

        .submenu-link {
            display: flex;
            align-items: center;
            padding: 0.6rem 1rem 0.6rem 3.5rem;
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: all var(--transition-speed) ease;
            font-size: 0.95rem;
            border-left: 2px solid transparent;
        }

        .submenu-link:hover {
            color: white;
            background: rgba(255, 255, 255, 0.05);
            border-left-color: var(--secondary-color);
        }

        .submenu-link.active {
            color: white;
            background: rgba(52, 152, 219, 0.15);
            border-left-color: var(--secondary-color);
        }

        .sidebar.collapsed .submenu-link {
            padding-left: 1rem;
        }

        /* Main Content */
        .main-wrapper {
            flex: 1;
            margin-left: var(--sidebar-width);
            transition: margin-left var(--transition-speed) ease;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .main-wrapper.collapsed {
            margin-left: var(--sidebar-width-collapsed);
        }

        .main-content {
            flex: 1;
            padding: 2rem;
        }

        /* Page Header */
        .page-header {var(--primary-dark) 100%);
            color: white;
            padding: 3rem 2rem;
            border-radius: 12px;
            margin-bottom: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            position: relative;
            overflow: hidden;
        }

        .page-header::before {
            content: '';.5rem;
            position: relative;
            z-index: 1;
        }

        .page-header p {
            margin: 0;
            opacity: 0.85;
            font-size: 1.1rem;
            position: relative;
            z-index: 1, 212, 255, 0.1);
            border-radius: 50%;
            transform: translate(50%, -50%
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .page-header h1 {
            font-weight: 700;
            margin-bottom: 0.5rem;
            font-size: 2rem;
        }

        .page-header p {linear-gradient(135deg, var(--secondary-color) 0%, #00a8cc 100%);
            color: white;
            border: none;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #00c9ff 0%, #00b8d4 100%);
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 212, 255, 0.4);
            color: white
            font-weight: 600;
            padding: 0.6rem 1.5rem;
            border-radiulinear-gradient(135deg, var(--success-color) 0%, #059669 100%);
        }

        .btn-success:hover {
            background: linear-gradient(135deg, #34d399 0%, #10b981 100%);
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(16, 185, 129, 0.4

        .btn-primary {
            background: var(--secondary-color);
            color: whitelinear-gradient(135deg, var(--danger-color) 0%, #dc2626 100%);
        }

        .btn-danger:hover {
            background: linear-gradient(135deg, #f87171 0%, #ef4444 100%);
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(239, 68, 68, 0.4);
        }

        .btn-warning {
            background: linear-gradient(135deg, var(--warning-color) 0%, #d97706 100%);
            color: white;
        }

        .btn-warning:hover {
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(245, 158, 11, 0.4);
            color: white

        .btn-danger {
            background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%);
            color: white;
        }

        .btn-secondary:hover {
            background: linear-gradient(135deg, #9ca3af 0%, #6b7280 100%);
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(107, 114, 128, 0.4

        .btn-warning {
            background: var(--warning-color);
            color: white;
        }
12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            margin-bottom: 1.5rem;
            background: white;
        }

        .card:hover {
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.12);
            transform: translateY(-4px);
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: white;
            border: none;
            font-weight: 600;
            padding: 1.75rem;
            border-radius: 12px 12
        /* Cards */
        .card {
            border: none;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            margin-bottom: 1.5rem;e5e7eb;
            background: #f9fafb;
            border-radius: 0 0 12px 12px
        }

        .card:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.12);
            transform: translateY(-2px);
        }

        .card-header {
            background: var(--primary-color);
            color: white;
            border: none;
            font-weight: 600;
            padding: 1.5rem;
            border-radius: 8px 8px 0 0 !important;
        }

        .card-body {
            padding: 2rem;
        }

        .card-footer {
            border-top: 1px solid #dee2e6;
        }

        /* Tables */
        .table {
            margin-bottom: 0;
        }

        .table thead th {
            background: #f8f9fa;
            color: var(--primary-color);
            font-weight: 700;
            border-bottom: 2px solid #dee2e6;
            padding: 1.25rem;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }

        .table tbody tr {
            transition: all 0.3s ease;
            border-bottom: 1px solid #dee2e6;
        }

        .table tbody tr:hover {
            background-color: #f8f9fa;
        }

        .table tbody td {
            padding: 1.25rem;
            vertical-align: middle;
        }

        /* Forms */
        .form-control, .form-select {
            border-radius: 6px;
            border: 1px solid #ddd;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
            font-size: 1rem;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }

        .form-label {
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            font-size: 0.875rem;
            letter-spacing: 0.5px;
        }

        /* Alerts */
        .alert {
            border: none;
            border-radius: 6px;
            border-left: 4px solid;
            animation: slideIn 0.3s ease;
        }

        .alert-success {
            border-left-color: var(--success-color);
            background-color: #e8f8f5;
            color: #229954;
        }

        .alert-danger {
            border-left-color: var(--danger-color);
            background-color: #fadbd8;
            color: #c0392b;
        }

        .alert-warning {
            border-left-color: var(--warning-color);
            background-color: #fef5e7;
            color: #a04000;
        }

        .alert-info {
            border-left-color: var(--secondary-color);
            background-color: #ebf5fb;
            color: #0e47a1;
        }

        /* Badge */
        .badge {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
        }

        .bg-success {linear-gradient(180deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: white;
            padding: 2.5rem 0;
            border-top: 2px solid rgba(255, 255, 255, 0.1);
            text-align: center;
        }

        footer p {
            margin: 0;
            opacity: 0.85;
            font-size: 0.95rem
            background: var(--primary-color);
            color: white;
            padding: 2rem 0;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
        }

        footer p {
            margin: 0;
            opacity: 0.9;
        }

        /* Animations */
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Scrollbar */
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 3px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: var(--sidebar-width-collapsed);
            }

            .sidebar.collapsed {
                width: var(--sidebar-width-collapsed);
            }

            .menu-item-label,
            .sidebar:not(.collapsed) .menu-item-label {
                display: none;
            }

            .main-wrapper {
                margin-left: var(--sidebar-width-collapsed);
            }

            .main-content {
                padding: 1rem;
            }

            .page-header {
                padding: 1.5rem;
            }

            .page-header h1 {
                font-size: 1.5rem;
            }

            .btn {
                padding: 0.5rem 1rem;
                font-size: 0.8rem;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="/" class="sidebar-brand">
                <i class="bi bi-shop"></i>
                <span>Tienda BNL</span>
            </a>
            <button class="toggle-sidebar" id="toggleSidebar" title="Colapsar menú">
                <i class="bi bi-chevron-left"></i>
            </button>
        </div>

        <ul class="sidebar-menu">
            <li>
                <a href="/" class="menu-item active">
                    <i class="bi bi-house-door"></i>
                    <span class="menu-item-label">Inicio</span>
                </a>
            </li>

            <li>
                <button class="menu-item has-submenu" data-submenu="marcasMenu">
                    <i class="bi bi-tags"></i>
                    <span class="menu-item-label">Gestión</span>
                    <i class="bi bi-chevron-down submenu-toggle"></i>
                </button>
                <ul class="submenu collapsed" id="marcasMenu">
                    <li>
                        <a href="{{ route('marcas.index') }}" class="submenu-link active">
                            <i class="bi bi-tag"></i>
                            <span>Marcas</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('marcas.create') }}" class="submenu-link">
                            <i class="bi bi-plus-circle"></i>
                            <span>Nueva Marca</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <button class="menu-item has-submenu" data-submenu="configuracionMenu">
                    <i class="bi bi-gear"></i>
                    <span class="menu-item-label">Configuración</span>
                    <i class="bi bi-chevron-down submenu-toggle"></i>
                </button>
                <ul class="submenu collapsed" id="configuracionMenu">
                    <li>
                        <a href="#" class="submenu-link">
                            <i class="bi bi-sliders"></i>
                            <span>Ajustes</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="submenu-link">
                            <i class="bi bi-person"></i>
                            <span>Usuarios</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </aside>

    <!-- Main Content -->
    <div class="main-wrapper" id="mainWrapper">
        <div class="main-content">
            <div class="container-fluid">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <h5><i class="bi bi-exclamation-circle"></i> Errores de validación</h5>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>

        <!-- Footer -->
        <footer>
            <p>&copy; 2026 Tienda BNL. Todos los derechos reservados.</p>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle Sidebar
        const toggleBtn = document.getElementById('toggleSidebar');
        const sidebar = document.getElementById('sidebar');
        const mainWrapper = document.getElementById('mainWrapper');

        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
            mainWrapper.classList.toggle('collapsed');

            // Guardar estado en localStorage
            localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
        });

        // Restaurar estado del sidebar
        window.addEventListener('DOMContentLoaded', () => {
            const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
            if (isCollapsed) {
                sidebar.classList.add('collapsed');
                mainWrapper.classList.add('collapsed');
            }
        });

        // Toggle Submenús
        const submenuButtons = document.querySelectorAll('.has-submenu');

        submenuButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();
                const submenuId = button.dataset.submenu;
                const submenu = document.getElementById(submenuId);
                
                button.classList.toggle('collapsed');
                submenu.classList.toggle('collapsed');
            });
        });

        // Resaltar menú activo
        const currentLocation = location.pathname;
        const menuItems = document.querySelectorAll('.submenu-link, .menu-item:not(.has-submenu)');

        menuItems.forEach(item => {
            if (item.getAttribute('href') === currentLocation) {
                item.classList.add('active');
                
                // Expandir submenú padre si es necesario
                const submenu = item.closest('.submenu');
                if (submenu) {
                    submenu.classList.remove('collapsed');
                    const button = submenu.previousElementSibling;
                    if (button) {
                        button.classList.remove('collapsed');
                    }
                }
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
