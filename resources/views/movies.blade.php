@extends('layouts.header')

@section('content')
    <!-- category banner -->

    <section>
        <div class="container mt-4">
            <div class="row text-center row-cols-2 row-cols-md-3 row-cols-lg-4" id="movie-list">
                @foreach ($medias as $movie)
                    <div class="col mb-4">
                        <div class="card card-height-media">
                            <div class="position-relative">
                                <a href="{{ route('detail', ['id' => $movie['id_media']]) }}">
                                    <img src="{{ asset('images/' . $movie['img_url']) }}" class="card-img-top img-fluid"
                                        alt="{{ $movie['title'] }}">
                                    <div class="overlay">
                                        <i class="fas fa-play"></i>
                                    </div>
                                </a>
                            </div>
                            <div class="card-body equal-movieHeight">
                                <p class="card-title text-sm card-title-fixed-height"><strong>{{ $movie['title'] }}</strong>
                                </p>
                                <p class="card-text text-left d-none d-md-block card-text-expand">
                                    <span class=" text-muted font-italic small">
                                        @foreach ($movie['actors'] as $actor)
                                            {{ $actor['name'] }}@if (!$loop->last)
                                                ,
                                            @endif
                                        @endforeach
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <script type="module">
        $(document).ready(function() {

            var currentUrl = window.location.pathname;

            var isSerie = false;
            if (currentUrl.includes('series')) {
                isSerie = true;
                $('#typeMedia').text("All Series");
                $('#typeMedia').attr('href', '{{ route('series') }}');
                $.each($('.genre-link'), function(index, value) {
                    var genreId = $(this).data('genre-id');
                    $(this).attr('href', "{{ route('serieByGenre', ['id' => '']) }}/" + genreId);

                    if (currentUrl.includes(genreId)) {

                        $(this).addClass('active');
                    } else {

                        $(this).removeClass('active');
                    }
                });

            } else {
                $.each($('.genre-link'), function(index, value) {
                    var genreId = $(this).data('genre-id');


                    if (currentUrl.includes(genreId)) {

                        $(this).addClass('active');
                    } else {

                        $(this).removeClass('active');
                    }
                });
            }


        });
    </script>
@endsection
