@extends('layouts.adminHeader')

@section('content')
    <h1>People List</h1>

    <section>
        <div>
            <div class="container-fluid py-3">
                <a id="new" class="btn btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#peopleModal">New
                    Person</a>

                <br>
            </div>
            <div id="tableDiv" class="container-fluid bg-light table-responsive my-4 p-3">
                <table id="peopleTable" class="display nowrap my-4 p-3 text-center" style="width: 100%">
                    <thead>
                        <tr class="align-middle h-100">
                            <th>ID</th>
                            <th>NAME</th>
                            <th>PROFESSION</th>
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
    <div class="modal fade" id="peopleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="peopleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="peopleModalLabel">Add Person</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form id="peopleForm" action="{{ route('admin.new.people') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">New Person Name:</label>
                            <input type="text" class="form-control" id="name" name="name">
                            <input type="hidden" name="oldName" id="oldName">

                        </div>

                        <div class="mb-3">
                            <label for="profession" class="form-label">Profession:</label>


                            <select class="form-select" id="profession" name="profession">
                                <option value="DIRECTOR">DIRECTOR</option>

                                <option value="ACTOR">
                                    ACTOR
                                </option>

                            </select>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="submitButton">Submit</button>


                    </div>
                </form>

            </div>
        </div>
    </div>




    <script type="module">
        var people = @json($people);
        console.log(people);

        function confirmDelete(id) {
            var confirmDelete = confirm("¿Are your sure to delete the people with ID " + id + "?");
            if (confirmDelete) {

                window.location.href = "{{ route('admin.delete.people', ['id' => ':id']) }}".replace(':id', id);
            }
        }

        $(document).ready(function() {


            $('#submitButton').click(function() {
                $('#peopleForm').submit();

            });

            $('#cancel').click(function() {

                $('#oldName').attr('value', null);
            });


            $('#peopleTable').on('click', '.modalAction', function() {
                var peopleName = $(this).data('name-people');
                $('#name').val(peopleName);
                $('#submitButton').text('Update');
                $('#peopleModalLabel').text('Edit Person');
                $('#oldName').attr('value', peopleName);


            });

            $('#peopleTable').on('click', '.btn-delete', function() {
                var id = $(this).data('id-people');
                confirmDelete(id);
            });

            var table = $('#peopleTable')
                .DataTable({
                    dom: 'Bfrtip',
                    select: true,
                    data: people,
                    responsive: true,
                    columns: [{
                            data: 'id_person'
                        },

                        {
                            data: 'name'
                        },
                        {
                            data: 'profession'
                        },


                        {
                            data: 'name',
                            orderable: false,
                            render: function(data, type, row) {
                                return '<div div class="d-flex justify-content-around">' +
                                    '<button class="btn btn-primary btn-sm m-1 modalAction" data-bs-toggle="modal" data-bs-target="#peopleModal" type="button" id="edit" data-name-people="' +
                                    data + '"><i class="fa fa-edit fa-lg"></i></button>' +
                                    '<button class="btn btn-danger btn-sm m-1 btn-delete" data-id-people="' +
                                    row.id_person +
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
