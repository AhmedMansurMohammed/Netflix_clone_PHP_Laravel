@extends('layouts.header')

@section('content')
    <!-- Series banner -->

    <section>
        <div class="container mt-4">
            <div class="row text-center row-cols-2 row-cols-md-3 row-cols-lg-4 id="serie-list">
                @foreach ($medias as $serie)
                    <div class="col mb-4">
                        <div class="card card-height-media">
                            <div class="position-relative">
                                <a href="{{ route('detail', ['id' => $serie['id_media']]) }}">
                                    <img src="{{ asset( 'images/' . $serie['img_url']) }}" class="card-img-top img-fluid"
                                        alt="{{ $serie['title'] }}">
                                    <div class="overlay">
                                        <i class="fas fa-play"></i>
                                    </div>
                                </a>
                            </div>
                            <div class="card-body equal-serieHeight">
                                <p class="card-title text-sm card-title-fixed-height"><strong>{{ $serie['title'] }}</strong></p>
                                <p class="card-text text-left d-none d-md-block card-text-expand">
                                    <span class=" text-muted font-italic small">
                                        @foreach ($serie['actors'] as $actor)
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
@endsection
