@extends('layouts.adminHeader')

@section('content')

    <h1>Serie List</h1>

    <section>

        <iframe class="container-fluid py-3" style="display: none; height:30rem" id="iframe-episode" ></iframe>
        <div>
            <div class="container-fluid py-3">
                <a id="new" class="btn btn-primary" href="{{ route('admin.new', ['isSerie' => true]) }}">New Serie</a>
                <br>
            </div>
            <div id="tableDiv" class="container-fluid bg-light table-responsive my-4 p-3">
                <table id="serieTable" class="display  my-4 p-3" style="width: 100%">
                    <thead>
                        <tr class="align-middle h-100">
                            <th>ID</th>
                            <th>IMAGE</th>
                            <th>TITLE</th>
                            <th>RELEASE YEAR</th>
                            <th>DIRECTOR</th>
                            <th>ACTORES</th>
                            <th>COUNTRY</th>
                            <th>GENRES</th>
                            <th>DESCRIPTION</th>
                            <th>LIKES</th>
                            <th>EPISODES</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <script type="module">
        var series = @json($series);
        console.log(series);

        function confirmDelete(idMedia) {
            var confirmDelete = confirm("¿Are your sure to delete the movie with ID " + idMedia + "?");
            if (confirmDelete) {

                window.location.href = "{{ route('admin.delete.media', ['id' => ':id']) }}".replace(':id', idMedia);
            }
        }

        $(document).ready(function() {

            $('#serieTable').on('click', '.btn-delete', function() {
                var idMedia = $(this).data('id-movie');
                confirmDelete(idMedia);
            });

            $('#serieTable').on('click', '.btn-all', function() {
                var id = $(this).data('id-all');
                var ruta="{{ route('admin.episodeList', ['id' => ':id']) }}".replace(':id', id);
                $('#iframe-episode').attr('src',ruta);
                $('#iframe-episode').css('display', 'block');
                $('html,body').animate({scrollTop:0},100);

            });

            $('#serieTable').on('click', '.btn-edit', function() {
                var idSerie = $(this).data('id-edit');
                
                var path="{{ route('admin.edit.media', ['id' => ':id']) }}".replace(':id', idSerie);
               
                console.log(path);
  
                window.location.href = path;
                
            });




            var table = $('#serieTable')
                .DataTable({
                    dom: 'Bfrtip',
                    select: true,
                    data: series,
                    responsive: true,
                    columns: [{
                            data: 'id_media'
                        },
                        {
                            data: 'img_url',
                            orderable: false,
                            render: function(data, type, row) {
                                return '<img src="{{ asset('images/') }}/' + data + '" alt="' + row
                                    .titulo +
                                    '" class="rounded" style="max-width: 65px; max-height: 65px;">';
                            }
                        },
                        {
                            data: 'title',
                        },
                        {
                            data: 'release_year'
                        },
                        {
                            data: 'director.name',
                        },
                        {
                            data: 'actors',
                            render: function(data) {
                                return data ? data.map(actor => actor.name).join('<br>') : '';
                            }
                        },
                        {
                            data: 'country.name'
                        },

                        {
                            data: 'genres',
                            orderable: false,
                            render: function(data) {
                                return data ? data.map(genre => genre.name).join('<br>') : '';
                            }
                        },
                        {
                            data: 'description',
                            orderable: false,
                            render: function(data, type, row) {
                                return '<div style="width: 150px; max-height: 150px;  overflow: hidden; text-overflow: ellipsis;" title="' +
                                    data + '">' + data + '</div>';
                            }
                        },

                        {
                            data: 'likes'
                        },
                        {
                            data: 'id_media',
                            orderable: false,
                            render: function(data, type, row) {
                                return '<button class="btn btn-success btn-sm m-1 btn-all" data-id-all="' + data +
                                '" type="button" id="edit">See Episodes</button>';
                            }
                        },
                        {
                            data: 'id_media',
                            orderable: false,
                            render: function(data, type, row) {
                                return '<div class="d-flex justify-content-around">' +
                                '<button class="btn btn-primary btn-sm m-1 btn-edit"  data-id-edit="' + data +
                                '"><i class="fa fa-edit fa-lg"></i></button>' +
                                '<button class="btn btn-danger btn-sm m-1 btn-delete" data-id-movie="' + data +
                                '"><i class="fa fa-trash fa-lg"></i></button>' +
                                '</div>';
                            }

                        }
                    ],
                    columnDefs: [{
                            target: 3,
                            render: DataTable.render.date(),

                        },
                        {
                            targets: '_all',
                            className: 'text-center'
                        }


                    ]
                });

        });
    </script>
@endsection
