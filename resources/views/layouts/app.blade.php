@php use Illuminate\Support\Facades\Auth;use Illuminate\Support\Facades\Route; @endphp
    <!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link sizes="76x76" href="../assets/img/e-locker.png">
    <link rel="icon" type="image/png" href="../assets/img/e-locker.png">
    <title>
        @yield('title')
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,800" rel="stylesheet"/>
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/757bf4501b.js" crossorigin="anonymous"></script>
    <!-- CSS Files -->
    <link id="pagestyle" href="../assets/css/soft-ui-dashboard.css?v=1.1.0" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    <script src="{{ asset('assets/js/signature/signature.js') }}"></script>
    @livewireStyles
</head>
<body class="g-sidenav-show  bg-gray-100">
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 "
       id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
           aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="{{ \route('dashboard') }}"
           target="_blank">
            <img src="{{ asset('assets/img/e-locker.png') }}" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold">E-Locker 2025</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            @if(Auth::user()->can('Dashboard'))
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-chart-line {{ Route::is('dashboard') ? '' : 'format-color' }} sidenav-icon"></i>
                        </div>
                        <span class="nav-link-text ms-1 font-weight-bold">Dashboard</span>
                    </a>
                </li>
            @endif
            @if(Auth::user()->can('Gerenciar unidades'))
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('unidades.index') ? 'active' : '' }}"
                       href="{{ route('unidades.index') }}">
                        <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-building-user mb-1 {{ Route::is('unidades.index') ? '' : 'format-color' }} sidenav-icon"></i>
                        </div>
                        <span class="nav-link-text ms-1 font-weight-bold">Unidades</span>
                    </a>
                </li>
            @endif
            @if(Auth::user()->can('Gerenciar entregas'))
                <li class="nav-item">
                    <a class="nav-link  {{ Route::is('entregas.create') ? 'active' : '' }}"
                       href="{{ route('entregas.create') }}">
                        <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-circle-plus mb-1 {{ Route::is('entregas.create') ? '' : 'format-color' }} sidenav-icon"></i>
                        </div>
                        <span class="nav-link-text ms-1 font-weight-bold">Nova Entrega</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link  {{ Route::is('entregas.index') ? 'active' : '' }}"
                       href="{{ route('entregas.index') }}">
                        <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-clock-rotate-left mb-1 {{ Route::is('entregas.index') ? '' : 'format-color' }} sidenav-icon"></i>
                        </div>
                        <span class="nav-link-text ms-1 font-weight-bold">Histórico de Entregas</span>
                    </a>
                </li>
            @endif
            @if(Auth::user()->can('Gerenciar usuários'))
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('usuarios.index') ? 'active' : '' }}"
                       href="{{ route('usuarios.index') }}">
                        <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-user mb-1 {{ Route::is('usuarios.index') ? '' : 'format-color' }} sidenav-icon"></i>
                        </div>
                        <span class="nav-link-text ms-1 font-weight-bold">Usuários</span>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</aside>
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
         navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb" class="no-mobile">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">
                        @if(Route::is('entregas.index') || Route::is('entregas.create'))
                            <span class="font-weight-bold">Entregas</span>
                        @elseif(Route::is('unidades.index'))
                            <span class="font-weight-bold">Unidades</span>
                        @elseif(Route::is('usuarios.index'))
                            <span class="font-weight-bold">Usuários</span>
                        @elseif(Route::is('dashboard'))
                            <span class="font-weight-bold">Dashboard</span>
                        @endif
                    </li>
                </ol>
                <h6 class="font-weight-bolder mb-0">
                    @if(Route::is('entregas.index'))
                        Gestão detalhada de entregas
                    @elseif(Route::is('entregas.create'))
                        Registro completo de entregas
                    @elseif(Route::is('unidades.index'))
                        Gerenciamento de unidades
                    @elseif(Route::is('usuarios.index'))
                        Gerenciamento de usuários
                    @elseif(Route::is('dashboard'))
                        Informações detalhadas
                    @endif
                </h6>
            </nav>
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4 mobile-format" id="navbar">
                <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                    <div class="input-group">
                        @php
                            $user = Auth::user();
                            $hour = date('H');
                        @endphp

                        @if($hour >= 5 && $hour < 12)
                            <h6 class="mt-2" style="margin-right: -8px;">Bom dia, {{ $user->name }}</h6>
                        @elseif($hour >= 12 && $hour < 18)
                            <h6 class="mt-2" style="margin-right: -8px;">Boa tarde, {{ $user->name }}</h6>
                        @else
                            <h6 class="mt-2" style="margin-right: -8px;">Boa noite, {{ $user->name }}</h6>
                        @endif
                    </div>
                </div>
                <ul class="navbar-nav justify-content-end">
                    <li class="nav-item d-flex align-items-center no-mobile">
                        <p class="mt-3 font-weight-bold" style="font-size: 12px;">|</p>
                    </li>
                    <li class="nav-item d-flex align-items-center">
                        <h6 class="mt-2" id="logout" style="margin-left: 8px;">Sair</h6>
                    </li>

                    <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                        <a href="javascript:" class="nav-link text-body p-0" id="iconNavbarSidenav">
                            <div class="sidenav-toggler-inner">
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        @yield('content')
    </div>
</main>
<!--   Core JS Files   -->
<script src="../assets/js/core/popper.min.js"></script>
<script src="../assets/js/core/bootstrap.min.js"></script>
<script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
<script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
<script src="{{ asset('assets/js/sweetalert2.js') }}"></script>

<form method="POST" action="{{ route('logout') }}" id="logoutForm" class="hidden">@csrf</form>

<script>
    document.getElementById('logout').addEventListener('click', function () {
        document.getElementById('logoutForm').submit();
    });
</script>
<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="../assets/js/soft-ui-dashboard.min.js?v=1.1.0"></script>
@livewireScripts
</body>

</html>
