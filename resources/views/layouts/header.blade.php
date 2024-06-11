<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <!-- Styles -->
    <style>
        body {
            min-height: 100vh;
            /* Para que el contenido ocupe al menos toda la altura de la pantalla */
        }
    </style>
</head>

<body class="antialiased">
    <header>
        <!-- place navbar here -->
        <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="" class="img-fluid" width="150"
                        height="150" />
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapsibleNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavbar">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link @if (Str::contains(Request::url(), 'home')) active @endif"
                                href="{{ route('home') }}" aria-current="page">Home <span
                                    class="visually-hidden">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if (Str::contains(Request::url(), 'movies')) active @endif"
                                href="{{ route('movies') }}">Movies</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if (Str::contains(Request::url(), 'series')) active @endif"
                                href="{{ route('series') }}">Series</a>
                        </li>
                        <form class="d-flex my-2 my-lg-0" action="{{ route('search') }}" method="GET">
                            <input class="form-control me-sm-2" type="text" placeholder="Search" name="query">
                            <!-- Agrega el atributo name="query" al campo de entrada -->
                            <button class="btn btn-danger my-2 my-sm-0" type="submit">Search</button>
                        </form>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <span>{{ session('email') }}</span>
                            </a>
                            <ul class="dropdown-menu bg-secondary text-light">
                                <li><a class="dropdown-item" href="{{ route('profile') }}">Profile</a></li>
                                <li><a class="dropdown-item" href="{{ route('favorites') }}">Favorite</a></li>
                                @if (session('role') === 'ADMIN')
                                    <li><a class="dropdown-item" href="{{ route('admin.movieList') }}">Settings</a>
                                    </li>
                                @endif
                                <li><a class="dropdown-item" href="{{ route('logout') }}">Log Out</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- category banner -->
        @if (Str::contains(Request::url(), 'movies') || Str::contains(Request::url(), 'series'))
            <!-- navbar de categoria -->
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container">
                    <a class="navbar-brand" href="{{ route('movies') }}" id="typeMedia">All Movies</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">
                            @foreach ($genres as $genre)
                                <li class="nav-item">
                                    <a class="nav-link genre-link"
                                        href="{{ route('movieByGenre', ['id' => $genre->id_genre]) }}"
                                        data-genre-id="{{ $genre->id_genre }}">{{ $genre->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </nav>
        @endif



    </header>
    
    {{-- content --}}
    @yield('content')
    <section>
        <!-- Footer -->
        <footer class="bg-dark text-center text-white">

            <!-- Copyright -->
            <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
                <p>© 2024 Copyright: Jinfeng Wang && Ahmed Mansur</p>
                <p>GitLab: <a class="text-white" href="https://gitlab.inf.edt.cat/a212025jw/cine_world">CineWorld</a></p>
                
            </div>
            <!-- Copyright -->
        </footer>
        <!-- Footer -->
    </section>
</body>

</html>
