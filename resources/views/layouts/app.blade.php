<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @livewireStyles

    <!-- CSS files -->
    <link href="./dist/css/tabler.min.css" rel="stylesheet" />

    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>

    <!-- Nightmare CSS -->
    <link rel="stylesheet" href="{{ asset('css/nightmare.css') }}">

    @yield('head')
</head>

<body>
    <div id="spinner"
        style="position: fixed; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.4); z-index: 9999; display: flex; flex-direction: column; justify-content: center; align-items: center; -webkit-backdrop-filter: blur(4px); backdrop-filter: blur(4px)">
        <div class="spinner-border text-white" role="status" style="width: 3rem; height: 3rem;"></div>
        <span class="spinner-text text-white text-bold">&nbsp; CARGANDO REGISTROS...</span>
    </div>
    <script src="./dist/js/demo-theme.min.js"></script>
    <div class="page">
        <!-- Navbar -->
        <header class="navbar navbar-expand-md d-print-none">
            <div class="container-xl">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
                    <a href=".">
                        <img src="{{ asset('static/logo-system.png') }}" width="110" height="32" alt="Tabler" class="navbar-brand-image">
                    </a>
                </h1>
                <div class="navbar-nav flex-row order-md-last">
                    <div class="d-none d-md-flex">
                        <a href="?theme=dark" class="nav-link px-0 hide-theme-dark" title="Activar modo oscuro"
                            data-bs-toggle="tooltip" data-bs-placement="bottom">
                            <x-heroicon-o-moon class="w-4 h-4 text-gray-400 me-4" />
                        </a>
                        <a href="?theme=light" class="nav-link px-0 hide-theme-light" title="Activar modo claro"
                            data-bs-toggle="tooltip" data-bs-placement="bottom">
                            <x-heroicon-o-sun class="w-4 h-4 text-gray-400 me-3" />
                        </a>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                            <span class="avatar avatar-sm" style="background-color: #ffffff; background-image: url(images/uploads/users/{{ Auth::user()->profile_photo }})"></span>
                            <div class="d-none d-xl-block ps-2">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="mt-1 small text-muted fst-italic">{{ Auth::user()->roles->pluck('name') }}</div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">Cerrar sesión</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <header class="navbar-expand-md">
            <div class="collapse navbar-collapse" id="navbar-menu">
                @include('layouts._navbar')
            </div>
        </header>

        <div class="page-wrapper">
            <!-- Page header -->
            <div class="page-header d-print-none">
                <div class="container-xl">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <!-- Page pre-title -->
                            <div class="page-pretitle">
                                @yield('pretitle')
                            </div>
                            <h2 class="page-title">
                                @yield('title')
                            </h2>
                        </div>
                        <!-- Page title actions -->
                        <div class="col-auto ms-auto d-print-none">
                            @yield('create')
                            <div class="btn-list">
                                <span class="d-none d-sm-inline">
                                    @yield('messages')
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    <div class="row row-deck row-cards">
                        <div class="col-12">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabler Core -->
    <script src="./dist/js/tabler.min.js" defer></script>
    <script src="./dist/js/demo.min.js" defer></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("spinner").style.display = "none";
        });
    </script>

    @livewireScripts
    @yield('scripts')
</body>

</html>