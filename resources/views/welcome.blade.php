@extends('layouts.header')

@section('content')
    <!-- Home Page banner -->

    <section class="bg-light text-dark p-5 text-center">
        <div class="container">
            <div class="d-sm-flex">
                <div>
                    <h1>Cine World</h1>
                    <p class="lead my-2 font-mobile">
                        Cine World es una plataforma en línea que ofrece una experiencia cinematográfica
                        excepcional para los amantes del cine y las series de televisión. Similar a Netflix, nuestro sitio
                        proporciona acceso a una amplia variedad de películas y programas de televisión de diferentes
                        géneros y épocas.
                    </p>
                    <p class="lead my-2 font-mobile">
                        Únete a nosotros en Cine World y sumérgete en un mundo de entretenimiento cinematográfico sin
                        límites. ¡Tu próxima aventura cinematográfica te espera!
                    </p>
                    {{-- <a href="{{ route('search') }}" class="btn btn-danger mt-3">Recent movies</a> --}}
                </div>
                <img src="https://www.teleadhesivo.com/blog/wp-content/uploads/2022/06/los-mejores-posters-de-pel%C3%ADculas-1024x640.jpg"
                    alt="showcaseImg" class="img-fluid w-50 d-none d-lg-block px-3" />
            </div>
        </div>
    </section>

    <!-- Movie banner -->
    <section>
        <section class="bg-dark text-light p-3">
            <div class="container">
                <h1>Movies</h1>
            </div>
        </section>
        <section class="bg-dark p-2">
            <div id="carouselMovieControls" class="carousel carousel-light slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach (array_chunk($movies, 3) as $movieChunk)
                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                            <div class="container mt-2">
                                <div class="row text-center row-cols-3 row-cols-md-3 row-cols-lg-3">
                                    @foreach ($movieChunk as $movie)
                                        <div class="col mb-4">
                                            <div class="card card-height">
                                                <div class="position-relative">
                                                    <a href="{{ route('detail',['id'=>$movie['id_media']]) }}">
                                                        <img src="{{ asset('images/' . $movie['img_url'] )}}" class="card-img-top img-fluid"
                                                            alt="{{ $movie['title'] }}">
                                                        <div class="overlay">
                                                            <i class="fas fa-play"></i>
                                                        </div>
                                                    </a>
                                                </div>

                                                <div class="card-body equal-height">
                                                    <h5 class="card-title card-title-fixed-height">
                                                        <strong>{{ $movie['title'] }}</strong></h5>
                                                    <p class="card-text card-text-expand">{{ $movie['description'] }}</p>
                                                    <a href="{{ route('detail' ,['id'=>$movie['id_media']]) }}" class="btn btn-danger btn-bottom">Ver película</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselMovieControls"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselMovieControls"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </section>

    </section>

    <!-- Series banner -->
    <section>
        <section class="bg-light text-dark p-3">
            <div class="container">
                <h1>Series</h1>
            </div>
        </section>
        <section class="bg-light p-2">
            <div id="carouselSeriesControls" class="carousel carousel-dark slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach (array_chunk($series, 3) as $serieChunk)
                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                            <div class="container mt-2">
                                <div class="row text-center row-cols-3 row-cols-md-3 row-cols-lg-3">
                                    @foreach ($serieChunk as $serie)
                                        <div class="col mb-4 ">
                                            <div class="card card-height">
                                                <div class="position-relative">
                                                    <a href="{{ route('detail',['id'=>$serie['id_media']]) }}">
                                                        <img src="{{ asset('images/' . $serie['img_url'])}}" class="card-img-top img-fluid"
                                                            alt="{{ $serie['title'] }}">
                                                        <div class="overlay">
                                                            <i class="fas fa-play"></i>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="card-body equal-height">
                                                    <h5 class="card-title card-title-fixed-height">
                                                        <strong>{{ $serie['title'] }}</strong></h5>
                                                    <p class="card-text card-text-expand">{{ $serie['description'] }}
                                                    </p>
                                                    <a href="{{ route('detail',['id'=>$serie['id_media']]) }}" class="btn btn-danger">Ver
                                                        serie</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselSeriesControls"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselSeriesControls"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
            </div>
        </section>

    </section>
@endsection
