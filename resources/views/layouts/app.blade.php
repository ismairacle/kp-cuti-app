<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Aplikasi Pengajuan Cuti - GYD</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <!-- Bootstrap CSS -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}

    @yield('css')

</head>

<body>
    <div id="app">
        @guest

        @else
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                    <a class="navbar-brand" href="
                            @if (Auth::user()->hasRole('user')) {{ route('index') }} @endif
                            @if (Auth::user()->hasRole('admin')) {{ route('admin') }} @endif
                            @if (Auth::user()->hasRole('approver')) {{ route('approver') }} @endif
                            "> <img src="{{ asset('img/gyd.jpg') }}" alt="" width="50"></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav me-auto">

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ms-auto">
                            <!-- Authentication Links -->

                            @if (Auth::user()->hasRole('user'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('index') }}">Beranda</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('riwayat') }}">Riwayat Pengajuan</a>
                                </li>
                            @endif

                            @if (Auth::user()->hasRole('admin') )
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin') }}">Data Pengajuan</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('all') }}">Data User</a>
                                </li>
                            @endif

                            @if (Auth::user()->hasRole('approver'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('approver') }}">Data Pengajuan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('rejected') }}">Data Ditolak</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('approved') }}">Data Diterima</a>
                            </li>
                        @endif




                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                                    @if (Auth::user()->hasRole('user'))
                                        <a class="dropdown-item" href="{{ route('profil') }}">Profil</a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                                                 document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        @endguest

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    @stack('scripts')

</body>

</html>
