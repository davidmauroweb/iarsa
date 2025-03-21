<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- Iconos -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Sweet Alert-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!--  <link rel="stylesheet" href="../style.css"> -->
    <!-- Scripts -->
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    <img src="img/logo.jpg" alt="IARSA Logo" width="60%" height="60%">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar Sesión') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    @if (Auth::user()->rol == "adm")
                                    <a class="dropdown-item" href="{{ route('lsus') }}">
                                    <i class="bi bi-people-fill"></i> Usuarios
                                    </a>
                                    <a class="dropdown-item" href="{{ route('lscomitentes') }}">
                                    <i class="bi bi-hospital-fill"></i> Comitentes
                                    </a>
                                    <a class="dropdown-item" href="{{ route('lsequipos') }}">
                                    <i class="bi bi-truck-front-fill"></i> Equipos
                                    </a>
                                    <a class="dropdown-item" href="{{ route('lsobras') }}">
                                    <i class="bi bi-cone-striped"></i> Obras
                                    </a>
                                    @endif
                                    @if (Auth::user()->rol == "mnt")
                                    <a class="dropdown-item" href="{{ route('lsequipos') }}">
                                    <i class="bi bi-truck-front-fill"></i> Equipos
                                    </a>
                                    @endif
                                    @if (Auth::user()->rol == "cnt")
                                    <a class="dropdown-item" href="{{ route('lsus') }}">
                                    <i class="bi bi-people-fill"></i> Usuarios
                                    </a>
                                    <a class="dropdown-item" href="{{ route('lscomitentes') }}">
                                    <i class="bi bi-hospital-fill"></i> Comitentes
                                    </a>
                                    <a class="dropdown-item" href="{{ route('lsobras') }}">
                                    <i class="bi bi-cone-striped"></i> Obras
                                    </a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="bi bi-box-arrow-left"></i> {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
@if (session('mensajeOk'))
<script>
    Swal.fire({
  position: "top-end",
  icon: "success",
  title: "{{session('mensajeOk')}}",
  showConfirmButton: false,
  timer: 4500
});
</script>
@endif

@if (session('mensajeNo'))
<script>
    Swal.fire({
  position: "top-end",
  icon: "error",
  title: "{{session('mensajeNo')}}",
  showConfirmButton: false,
  timer: 4500
});
</script>
@endif

@if (session('messages'))
<script>
    Swal.fire({
  position: "top-end",
  icon: "info",
  title: "{{session('messages')}}",
  showConfirmButton: false,
  timer: 4500
});
@endif
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
