@extends('layouts.iframHeader')

@section('content')
    <h2>Episode List (Serie:{{$id_media}})</h2>
    <section>
        <div>
            <div class="container-fluid py-3">

                <a id="new" class="btn btn-primary" href="{{ route('admin.new.episode', ['id' => $id_media]) }}">New Episode</a>
                <br>
            </div>
            <div id="tableDiv" class="container-fluid bg-light table-responsive my-4 p-3">
                <table id="episodeTable" class="display nowrap my-4 p-3 text-center" style="width: 100%">
                    <thead>
                        <tr class="align-middle h-100">
                            <th>ID</th>
                            <th>TITLE</th>
                            <th>URL</th>
                            <th>DURATION</th>
                            <th>DESCRIPTION</th>
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

        var episodes = @json($episodes);
        console.log(episodes);

        function confirmDelete(id) {
            var confirmDelete = confirm("¿Are your sure to delete the episode with ID " + id + "?");
            if (confirmDelete) {

                window.location.href = "{{ route('admin.delete.episode', ['id' => ':id']) }}".replace(':id', id);
            }
        }

        $(document).ready(function() {


            $('#episodeTable').on('click', '.btn-delete', function() {
                var id = $(this).data('id-episode');
                confirmDelete(id);
            });

            $('#episodeTable').on('click', '.btn-edit', function() {
                var idEpisode = $(this).data('id-edit');
                
                var path="{{ route('admin.edit.episode', ['id' => ':id']) }}".replace(':id', idEpisode);
               
                console.log(path);
  
                window.location.href = path;
                
            });


        });

        var table = $('#episodeTable')
                .DataTable({
                    dom: 'Bfrtip',
                    select: true,
                    data: episodes,

                    columns: [
                        {
                            data: 'id_episode'
                        },

                        {
                            data: 'title'
                        },
                        {
                            data: 'url'
                        },
                        {
                            data: 'duration'
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
                            data: 'id_episode',
                            orderable: false,
                            render: function(data, type, row) {
                                return '<div class="d-flex justify-content-around">' +
                                '<button class="btn btn-primary btn-sm m-1 btn-edit"  data-id-edit="' + data +
                                '"><i class="fa fa-edit fa-lg"></i></button>' +
                                    '<button class="btn btn-danger btn-sm m-1 btn-delete" data-id-episode="' +
                                    data +
                                    '"><i class="fa fa-trash fa-lg"></i></button>' +
                                    '</div>';
                            }

                        }
                    ],
                    columnDefs: [{
                        targets: '_all',
                        className: 'text-center'
                    }]

                });

    </script>
@endsection
