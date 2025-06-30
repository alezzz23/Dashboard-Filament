<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Figtree', sans-serif;
            padding-top: 70px; /* Para compensar el navbar fijo */
        }
        .navbar {
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
        }
        .dropdown-menu {
            min-width: 220px;
        }
        .dropdown-item {
            padding: 0.5rem 1.5rem;
        }
        .navbar-brand {
            font-weight: 600;
        }
    </style>
</head>
<body class="antialiased">
    <!-- Navbar -->
    <x-navbar />

    <!-- Page Content -->
    <main class="py-4">
        <div class="container">
            @yield('content')
            
            <!-- Welcome Content -->
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Bienvenido a la Aplicación') }}</div>

                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            {{ __('¡Has iniciado sesión correctamente!') }}
                            
                            <div class="mt-4">
                                <p>Este es un ejemplo de página de bienvenida con una barra de navegación responsiva.</p>
                                <p>La barra de navegación incluye:</p>
                                <ul>
                                    <li>Menú desplegable para móviles</li>
                                    <li>Enlaces de navegación</li>
                                    <li>Menú de usuario con opciones de perfil y cierre de sesión</li>
                                    <li>Diseño responsivo</li>
                                    <li>Iconos de Font Awesome</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom Scripts -->
    @stack('scripts')
</body>
</html>