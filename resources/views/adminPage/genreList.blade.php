@extends('layouts.adminHeader')

@section('content')

    <h1>Genre List</h1>

    <section>
        <div>
            <div class="container-fluid py-3">

                <a id="new" class="btn btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#genreModal">New
                    Genre</a>
                <br>
            </div>
            <div id="tableDiv" class="container-fluid bg-light table-responsive my-4 p-3">
                <table id="genreTable" class="display nowrap my-4 p-3 text-center" style="width: 100%">
                    <thead>
                        <tr class="align-middle h-100">
                            <th>ID</th>
                            <th>NAME</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="genreModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="genreModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                
                <div class="modal-header">
                    <h5 class="modal-title" id="genreModalLabel">Add Genre</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form id="genreForm" action="{{ route('admin.new.genre') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">New Genre Name:</label>
                            <input type="text" class="form-control" id="name" name="name">
                            <input type="hidden" name="oldName" id="oldName">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            id="cancel">Cancel</button>
                        <button type="button" class="btn btn-primary" id="submitButton">Submit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script type="module">
        var genres = @json($genres);
        console.log(genres);

        function confirmDelete(id) {
            var confirmDelete = confirm("¿Are your sure to delete the genre with ID " + id + "?");
            if (confirmDelete) {

                window.location.href = "{{ route('admin.delete.genre', ['id' => ':id']) }}".replace(':id', id);
            }
        }

        $(document).ready(function() {

            $('#submitButton').click(function() {

                $('#genreForm').submit();
            });

            $('#cancel').click(function() {

                $('#oldName').attr('value', null);
            });


            $('#genreTable').on('click', '.modalAction', function() {
                var genreName = $(this).data('name-genre');
                $('#name').val(genreName);
                $('#submitButton').text('Update');
                $('#genreModalLabel').text('Edit Genre');
                $('#oldName').attr('value', genreName);


            });

            $('#genreTable').on('click', '.btn-delete', function() {
                var id = $(this).data('id-genre');
                confirmDelete(id);
            });




            var table = $('#genreTable')
                .DataTable({
                    dom: 'Bfrtip',
                    select: true,
                    data: genres,
                    responsive: true,
                    columns: [{
                            data: 'id_genre'
                        },

                        {
                            data: 'name'
                        },


                        {
                            data: 'name',
                            orderable: false,
                            render: function(data, type, row) {
                                return '<div div class="d-flex justify-content-around">' +
                                    '<button class="btn btn-primary btn-sm m-1 modalAction" data-bs-toggle="modal" data-bs-target="#genreModal" type="button" id="edit" data-name-genre="' +
                                    data + '"><i class="fa fa-edit fa-lg"></i></button>' +
                                    '<button class="btn btn-danger btn-sm m-1 btn-delete" data-id-genre="' +
                                    row.id_genre +
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





        });
    </script>
@endsection
