<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    {{-- sweet alert --}}
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.13.2/dist/sweetalert2.min.css" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Aplikasi Pengaduan Siswa
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        @auth
                            @if (Auth::user()->role == 'admin')
                                <li class="nav-item">
                                    <a href="{{ route('admin.dashboard') }}" class="nav-link">Dashboard</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('user.siswa.index') }}" class="nav-link">Daftar Siswa</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('user.parent.index') }}" class="nav-link">Daftar Orang Tua Murid</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('profile.admin') }}" class="nav-link">Profile</a>
                                </li>
                            @elseif (Auth::user()->role == 'siswa')
                                <li class="nav-item">
                                    <a href="{{ route('siswa.dashboard') }}" class="nav-link">Dashboard</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('profile.siswa') }}" class="nav-link">Profile</a>
                                </li>
                            @elseif (Auth::user()->role == 'parent')
                                <li class="nav-item">
                                    <a href="{{ route('parent.dashboard') }}" class="nav-link">Dashboard</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('profile.parent') }}" class="nav-link">Profile</a>
                                </li>
                            @elseif (Auth::user()->role == 'kepsek')
                                <li class="nav-item">
                                    <a href="{{ route('kepsek.dashboard') }}" class="nav-link">Dashboard</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('profile.kepsek') }}" class="nav-link">Profile</a>
                                </li>
                            @endif
                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @auth
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    @if (Auth::user()->role =='admin' || Auth::user()->role =='kepsek')
                                        {{ ucwords(Auth::user()->username) }}
                                    @elseif (Auth::user()->role =='siswa')
                                        {{ ucwords(Auth::user()->student->nama) }}
                                    @elseif (Auth::user()->role =='parent')
                                        {{ ucwords(Auth::user()->parents->nama) }}
                                    @endif
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.13.2/dist/sweetalert2.all.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    {{-- Sweat Alert Script --}}
    @yield('script')
    @if (Session::has('success'))
        <script>
            Swal.fire({
                title: "Berhasil",
                text: "{{ Session::get('success') }}",
                icon: "success",
            });
        </script>
    @elseif (Session::has('error'))
        <script>
            Swal.fire({
                title: "Gagal",
                text: "{{ Session::get('error') }}",
                icon: "error",
            });
        </script>
    @endif
</body>
</html>
