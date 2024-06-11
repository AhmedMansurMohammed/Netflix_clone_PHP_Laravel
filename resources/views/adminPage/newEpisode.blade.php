@extends('layouts.iframHeader')

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
  

            <h1 class="m-5 text-center">ADD NEW EPISODE</h1>
  

        <form action="{{ route('media.insert.episode') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id_media" value={{$media->id_media}}>
            <div class="mb-3">
                <label for="serie" class="form-label">Serie</label>
                <input type="text" class="form-control" id="serie" value="{{ $media->title }}" name="serie" disabled>
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Episode Title</label>
                <input type="text" class="form-control" id="title" value="{{ old('title') }}" name="title">
            </div>
            <div class="mb-3">
                <label for="season" class="form-label">Season</label>
                <select class="form-select" id="season" name="season">
                    <option value="">Select season</option>
                    <option value="1">Season 1</option>
                    <option value="2">Season 2</option>
                    <option value="3">Season 3</option>
                </select>
            </div>

            <div class="form-group">
                <label for="url">URL:</label>
                <input type="url" name="url" id="url" value="{{ old('url') }}" class="form-control">
            </div>
            <div class="form-group">
                <label for="duration">Duration(min):</label>
                <input type="number" name="duration" id="duration" value="{{ old('duration') }}"
                    class="form-control">
            </div>


            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
            </div>




            <button type="submit" class="btn btn-danger my-5">Save</button>
        </form>
    </div>


@endsection
