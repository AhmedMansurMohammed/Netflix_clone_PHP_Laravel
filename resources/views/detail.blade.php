@extends('layouts.header')

@section('content')
    <section class="container mt-5 mb-5">
        <div class="row">
            <!-- Movie details content, similar to your previous code -->
            <div class="col-md-6">
                <img src="{{ asset('images/' . $media['img_url']) }}" class="img-fluid movie-poster" alt="Movie Poster">
            </div>
            <div class="col-md-6 d-flex flex-column justify-content-between">
                <div>
                    <h2 class="my-3">{{ $media['title'] }}</h2>
                    <p><strong>Director:</strong> {{ $media['director']['name'] }}</p>
                    <p><strong>Cast:</strong> {{ implode(',', $actors) }} </p>
                    <p><strong>Release Date:</strong> {{ $media['release_year'] }}</p>
                    <p><strong>Genre:</strong> {{ implode(',', $genres) }}</p>
                    <p><strong>Likes:</strong> {{ $media['likes'] }}</p>
                </div>

                <div class="my-3">
                    <button type="button" class="btn btn-dark like-btn align-self-end me-2"
                        data-media-id="{{ $media['id_media'] }}">
                        <i class="{{ $isFavorited ? ' fas' : 'far' }} fa-heart"></i> Like
                    </button>
                    @if (isset($media['episodes'][0]))
                        <a type="button" target="_blank" class="btn btn-danger align-self-end me-2"
                            href="{{ route('video', ['id' => $media['episodes'][0]['id_episode']]) }}"><i
                                class="fas fa-play"></i> Play</a>
                    @endif

                </div>
            </div>
        </div>
        <hr>

        <div class="row mt-1">
            <div class="col-md-12">
                <h3 class="mt-4">Description</h3>
                <p>{{ $media['description'] }}</p>
            </div>
            <div class="col-md-12 mt-4">
                @if (!$media['isSerie'])
                    <h3>Playlist</h3>
                @endif

                <ul class="list-group mb-3">
                    @php
                        $season = '';
                    @endphp

                    @foreach ($media['episodes'] as $episode)
                        @if ($episode['season'] != $season)
                            <h4>Season {{ $episode['season'] }}</h4>
                            @php
                                $season = $episode['season'];
                            @endphp
                        @endif
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('images/' . $media['img_url']) }}" alt="Video Thumbnail"
                                    class="video-thumbnail me-3">
                                <div>
                                    <h5 class="mb-1">{{ $episode['title'] }}</h5>
                                    <p class="mb-1 description">{{ $episode['description'] }}</p>
                                </div>
                            </div>

                            <div class="d-flex flex-column align-items-end text-center">
                                <a type="button" target="_blank" class="btn btn-danger  mb-2 "
                                    href="{{ route('video', ['id' => $episode['id_episode']]) }}"><i
                                        class="fas fa-play"></i></a>
                                <span>{{ $episode['duration'] }} min</span>

                            </div>
                        </li>
                    @endforeach

                </ul>
            </div>
        </div>
    </section>
    <script type="module">
        $('.like-btn').click(function() {
            var mediaId = $(this).data('media-id');
            var likeBtn = $(this);


            $.ajax({
                type: 'POST',
                url: '{{ route('like-media') }}',
                data: {
                    id_media: mediaId,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (!response) {
                        //agregar
                        likeBtn.find('i').removeClass('far').addClass('fas');
                    } else {
                        // borrar
                        likeBtn.find('i').removeClass('fas').addClass('far');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    </script>
@endsection
