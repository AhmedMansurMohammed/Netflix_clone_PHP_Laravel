@extends('layouts.header')

@section('content')

<section class="container mt-5 mb-5">
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <h1 class="mb-4">{{$media->title}}</h1>
            </div>

            <div class="col-12">
                {{-- {{$episode->url}} --}}
                <iframe class="w-100" src="https://mega.nz/embed/354WUYAY#fQwtOvU0mDl0FUR6ZqZxZPwZnLWpFXlRsL02W9upoyE"  height="720px" frameborder="0" allowfullscreen></iframe>
            </div>
            <div class="col-12 mt-4">
                @if($media->isSerie)
                <h2>{{$episode->title}} </h2>
                <p>{{$episode->description}}</p>
                @else
                <h2>{{$media->description}} </h2>
                @endif
            </div>
        </div>
    </div>
</section>


@endsection