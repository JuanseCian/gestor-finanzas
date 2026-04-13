<!DOCTYPE html>
<html lang="es" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión Personal</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .navbar {
            backdrop-filter: blur(10px);
            background-color: rgba(var(--bs-body-bg-rgb), 0.85) !important;
            border-bottom: 1px solid var(--bs-border-color-translucent);
        }

        .card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 .5rem 1.5rem rgba(0,0,0,.1)!important;
            cursor: pointer;
        }

        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: var(--bs-secondary-bg); border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: var(--bs-secondary); }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

<nav class="navbar navbar-expand-lg sticky-top py-3">
    <div class="container">
        <a href="{{ route('home') }}" class="navbar-brand fw-bold d-flex align-items-center gap-2 text-primary">
            <i class="bi bi-wallet2 fs-4"></i>
            <span>FinanceTrack</span>
        </a>

        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 fw-medium">
                @auth
                <li class="nav-item">
                    <a class="nav-link px-3 rounded-3 {{ request()->routeIs('dashboard') ? 'active bg-primary-subtle text-primary' : '' }}" href="{{ route('dashboard') }}">Panel</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 rounded-3 {{ request()->routeIs('transacciones.*') ? 'active bg-primary-subtle text-primary' : '' }}" href="{{ route('transacciones.index') }}">Transacciones</a>
                </li>
                @endauth
            </ul>

            <div class="d-flex align-items-center gap-3 mt-3 mt-lg-0">
                <button id="toggleTheme" class="btn btn-link nav-link px-2 d-flex align-items-center text-body" aria-label="Cambiar tema">
                    <i class="bi bi-moon-stars-fill fs-5"></i>
                </button>

                @auth
                <div class="dropdown">
                    <button class="btn btn-outline-secondary border-light-subtle dropdown-toggle rounded-pill shadow-sm d-flex align-items-center gap-2 px-3 py-2 bg-body" type="button" data-bs-toggle="dropdown">
                        <img src="{{ auth()->user()->foto ?? 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->name).'&background=random' }}" 
                             alt="Avatar" class="rounded-circle" width="24" height="24">
                        <span class="d-none d-sm-inline fw-medium">{{ auth()->user()->name }}</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2 rounded-4 py-2">
                        <li><a class="dropdown-item py-2 px-4" href="{{ route('dashboard') }}"><i class="bi bi-speedometer2 me-2 text-primary"></i> Mi Panel</a></li>
                        <!-- Enlace al Perfil actualizado -->
                        <li><a class="dropdown-item py-2 px-4 {{ request()->routeIs('profile.edit') ? 'active' : '' }}" href="{{ route('profile.edit') }}"><i class="bi bi-person me-2 text-info"></i> Perfil</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item text-danger py-2 px-4 w-100 text-start border-0 bg-transparent"><i class="bi bi-box-arrow-right me-2"></i> Cerrar sesión</button>
                            </form>
                        </li>
                    </ul>
                </div>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-primary rounded-pill px-4 fw-medium">Ingresar</a>
                    <a href="{{ route('register') }}" class="btn btn-primary rounded-pill px-4 fw-medium">Registrarse</a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<main class="flex-grow-1 py-4">
    <div class="container">
        @yield('content')
    </div>
</main>

<footer class="mt-auto py-4 text-center text-muted small border-top border-light-subtle">
    <div class="container">
        &copy; {{ date('Y') }} FinanceTrack. Todos los derechos reservados.
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const html = document.documentElement;
    const toggleBtn = document.getElementById('toggleTheme');
    
    const setTheme = (theme) => {
        html.setAttribute('data-bs-theme', theme);
        toggleBtn.innerHTML = theme === 'dark' 
            ? '<i class="bi bi-sun-fill fs-5 text-warning"></i>' 
            : '<i class="bi bi-moon-stars-fill fs-5 text-secondary"></i>';
        localStorage.setItem('theme', theme);
    };

    const getPreferredTheme = () => {
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme) {
            return savedTheme;
        }
        return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
    };

    setTheme(getPreferredTheme());

    toggleBtn.addEventListener('click', () => {
        const currentTheme = html.getAttribute('data-bs-theme');
        setTheme(currentTheme === 'dark' ? 'light' : 'dark');
    });
</script>

</body>
</html>