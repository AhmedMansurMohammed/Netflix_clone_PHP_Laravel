@extends('layouts.header')

@section('content')
    <div class="container">
        <h1>Your favorite movies</h1>
        @if ($favoriteMedias->isEmpty())
            <p>No favorite media found.</p>
        @else
            <div class="row">
                @foreach ($favoriteMedias as $favoriteMedia)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="position-relative">
                                <a href="{{ route('detail', ['id' => $favoriteMedia['id_media']]) }}">
                                    <img src="{{ asset('images/' . $favoriteMedia['img_url']) }}"
                                        class="card-img-top img-fluid" alt="{{ $favoriteMedia['title'] }}">
                                    <div class="overlay">
                                        <i class="fas fa-play"></i>
                                    </div>
                                </a>
                            </div>
                            <div class="card-body card-custom">
                                <h5 class="card-title card-title-fixed-height">{{ $favoriteMedia->title }}</h5>
                                <p class="card-text card-title-fixed-height">{{ $favoriteMedia->description }}</p>
                                <p class="card-text text-left d-none d-md-block card-text-expand">Director:
                                    {{ $favoriteMedia->director }}</p>
                                <p class="card-text">Release Year: {{ $favoriteMedia->release_year }}</p>
                                <p class="card-text">Country: {{ $favoriteMedia->country }}</p>
                                <p class="card-text">Genres:
                                    @foreach ($favoriteMedia->genres as $genre)
                                        {{ $genre->name }}@if (!$loop->last)
                                            ,
                                        @endif
                                    @endforeach
                                </p>
                                <p class="card-text">Actors:
                                    @foreach ($favoriteMedia->actors as $actor)
                                        {{ $actor->name }}@if (!$loop->last)
                                            ,
                                        @endif
                                    @endforeach
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
