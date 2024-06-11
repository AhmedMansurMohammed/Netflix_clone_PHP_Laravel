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
            margin: 0;
        }
    </style>
</head>

<body class="antialiased">
    <!-- Header -->
    <header class="adminHeader">
        <div>
            <h1 class="m-0"><a class="mb-3 mb-md-auto text-white text-decoration-none" href="{{ route('home') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="" class="img-fluid" width="150"
                        height="150" />
                </a></h1>
        </div>
        <button id="toggleBtn" class="toggle-btn btn btn-dark d-md-none"><i class="fas fa-bars"></i></button>
    </header>

    <!-- Sidebar -->
    <div id="sidebar" class="d-md-block d-none sidebar ">
        <div class="d-flex flex-column p-3 text-white " style="height: calc(100vh - 60px);">

            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="{{ route('admin.movieList') }}" class="nav-link text-white">Movies List</a>
                    <hr>
                </li>
                <li>
                    <a href="{{ route('admin.serieList') }}" class="nav-link text-white">Series List</a>
                    <hr>
                </li>
                <li>
                    <a href="{{ route('admin.genreList') }}" class="nav-link text-white">Genres List</a>
                    <hr>
                </li>
                <li>
                    <a href="{{ route('admin.countryList') }}" class="nav-link text-white">Countries List</a>
                    <hr>
                </li>
                <li>
                    <a href="{{ route('admin.peopleList') }}" class="nav-link text-white">People List</a>
                    <hr>
                </li>
            </ul>
            <hr>
        </div>
    </div>

    <!-- Content -->
    <div class="admin ">
        <div class=" mt-5 pt-5 ">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @yield('content')
        </div>
    </div>

    <!-- JavaScript para el botón de alternar la barra lateral -->
    <script type="module">
        $(document).ready(function() {
            const toggleBtn = $('#toggleBtn');
            const sidebar = $('#sidebar');
            const adminDiv = $('.admin');

            toggleBtn.on('click', function() {
                sidebar.toggleClass('d-none');
                if (sidebar.hasClass('d-none')) {
                    adminDiv.css('display', 'block');
                } else {
                    adminDiv.css('display', 'none');
                }
            });
        });
    </script>
</body>

</html>
