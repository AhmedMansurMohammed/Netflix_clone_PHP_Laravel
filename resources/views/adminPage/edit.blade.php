@extends('layouts.header')

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container">
        @if ($isSerie == 1)
            <h1 class="m-5 text-center">UPDATE SERIE</h1>
        @else
            <h1 class="m-5 text-center">UPDATE MOVIE</h1>
        @endif

        <form action="{{ route('media.insert') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{$media->id_media}}">

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" value="{{$media->title}}" name="title">
            </div>

            <div class="mb-3">
                <label for="release_year" class="form-label">Release Year</label>
                <input type="number" class="form-control" id="release_year" value="{{$media->release_year}}"
                    name="release_year" placeholder="Ex: 2020">
            </div>


            <div class="mb-3">
                <label for="director" class="form-label">Director</label>
                <select class="form-select" id="director" name="director">
                    <option value="">Select Director</option>
                    @foreach ($people as $director)
                    
                        @if ($director['profession'] == 'DIRECTOR')
                            <option value="{{ $director['name'] }}"
                                {{ $media->director == $director['id_person'] ? 'selected' : '' }}>
                                {{ $director['name'] }}
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>



            <div class="mb-3">
                <label class="form-label">Actors</label>
                <div class="row">
                    @foreach ($people as $actor)
                        @if ($actor['profession'] == 'ACTOR')
                            <div class="col-lg-2 col-sm-3">
                                <div class="form-check">
                                    <br>
                                    <input class="form-check-input" type="checkbox" id="actor_{{ $actor['id_person'] }}"
                                        name="actors[]" value="{{ $actor['id_person'] }}"
                                        {{  $media->actors->contains($actor) ? 'checked' : '' }}>
                                    <label class="form-check-label"
                                        for="actor_{{ $actor['id_person'] }}">{{ $actor['name'] }}</label>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>


            <div class="mb-3">
                <label for="img_url" class="form-label">Image</label>
                <input type="file" class="form-control" id="img_url" name="img_url" accept="image/*">
            </div>


            <div class="mb-3">
                <label for="country" class="form-label">Country</label>
                <select class="form-select" id="country" name="country">
                    <option value="">Select Country</option>
                    @foreach ($countries as $c)
                
                        <option value="{{ $c['name'] }}" {{ $media->country == $c['id_country'] ? 'selected' : '' }}>
                            {{ $c['name'] }}
                        </option>
                    @endforeach
                </select>
            </div>


            <div class="mb-3">
                <label for="genres" class="form-label">Genres</label>
                <div class="row">
                    @foreach ($genres as $genre)
                        <div class="col-lg-2 col-sm-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="genre_{{ $genre->id_genre }}"
                                    name="genres[]" value="{{ $genre->id_genre }}"
                                    {{ $media->genres->contains($genre) ? 'checked' : '' }}>
                                <label class="form-check-label"
                                    for="genre_{{ $genre->id_genre }}">{{ $genre->name }}</label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>




            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3">{{ $media->description }}</textarea>
            </div>



            <input type="hidden" name="isSerie" id="isSerie" value="{{ $isSerie }}">

            @if ($isSerie == 1)
                <div class="alert alert-warning" role="alert">
                    Los episodios se agregarán más tarde.
                </div>
            @else
                <div class="form-group">
                    <label for="url">URL:</label>
                    <input type="url" name="url" id="url" value="{{ $media->episodes[0]->url }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="duration">Duration(min):</label>
                    <input type="number" name="duration" id="duration" value="{{ $media->episodes[0]->duration}}"
                        class="form-control">
                </div>
            @endif


            <button type="submit" class="btn btn-danger my-5">Save</button>
        </form>
    </div>


@endsection
