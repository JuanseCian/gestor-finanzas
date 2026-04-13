<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión Personal</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #121212;
            color: white;
        }

        .navbar {
            background-color: #1e1e1e;
        }

        .dropdown-menu {
            background-color: #2a2a2a;
        }

        .dropdown-item {
            color: white;
        }

        .dropdown-item:hover {
            background-color: #444;
        }
    </style>
</head>
<body>

<!-- HEADER -->
<nav class="navbar navbar-expand-lg px-4">

    <!-- IZQUIERDA -->
    <span class="navbar-brand text-white fw-bold">
        Gestión Personal
    </span>

    <!-- DERECHA -->
    <div class="ms-auto">

        @auth
        <div class="dropdown">

            <button class="btn btn-outline-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                👤 {{ auth()->user()->name }}
            </button>

            <ul class="dropdown-menu dropdown-menu-end">

                <li>
                    <a class="dropdown-item" href="{{ route('dashboard') }}">
                        Panel
                    </a>
                </li>

                <li>
                    <a class="dropdown-item" href="{{ route('transacciones.index') }}">
                        Transacciones
                    </a>
                </li>

                <li>
                    <a class="dropdown-item" href="#">
                        Balance
                    </a>
                </li>

                <li>
                    <a class="dropdown-item" href="#">
                        Estadísticas
                    </a>
                </li>

                <li><hr class="dropdown-divider"></li>

                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="dropdown-item text-danger">
                            Cerrar sesión
                        </button>
                    </form>
                </li>

            </ul>
        </div>
        @else
            <a href="{{ route('login') }}" class="btn btn-outline-light me-2">Login</a>
            <a href="{{ route('register') }}" class="btn btn-warning">Registro</a>
        @endauth

    </div>

</nav>

<!-- CONTENIDO -->
<div class="container mt-4">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>