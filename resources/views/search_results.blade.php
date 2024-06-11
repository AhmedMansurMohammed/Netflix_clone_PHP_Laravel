@extends('layouts.header')

@section('content')
    <div class="container">
        <h2>Search Results for "{{ $query }}"</h2>
        @if ($medias->isEmpty())
            <p>No results found.</p>
        @else
            <div class="row">
                @foreach ($medias as $media)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="position-relative">
                                <a href="{{ route('detail', ['id' => $media['id_media']]) }}">
                                    <img src="{{ asset( 'images/' . $media['img_url']) }}" class="card-img-top img-fluid"
                                        alt="{{ $media['title'] }}">
                                    <div class="overlay">
                                        <i class="fas fa-play"></i>
                                    </div>
                                </a>
                            </div>
                            <div class="card-body card-custom">
                                <h5 class="card-title card-title-fixed-height">{{ $media->title }}</h5>
                                <p class="card-text card-title-fixed-height">{{ $media->description }}</p>
                                <p class="card-text text-left d-none d-md-block card-text-expand">Director:
                                    {{ $media->director }}</p>
                                <p class="card-text">Release Year: {{ $media->release_year }}</p>
                                <p class="card-text">Country: {{ $media->country }}</p>
                                <p class="card-text">Genres:
                                    @foreach ($media->genres as $genre)
                                        {{ $genre->name }}@if (!$loop->last)
                                            ,
                                        @endif
                                    @endforeach
                                </p>
                                <p class="card-text">Actors:
                                    @foreach ($media->actors as $actor)
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
