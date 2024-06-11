@extends('layouts.adminHeader')

@section('content')

    <h1>Country List</h1>

    <section>
        <div>
            <div class="container-fluid py-3">
                <a id="new" class="btn btn-primary" href="#" data-bs-toggle="modal"
                    data-bs-target="#countryModal">New Country</a>

                <br>
            </div>
            <div id="tableDiv" class="container-fluid bg-light table-responsive my-4 p-3">
                <table id="countryTable" class="display nowrap my-4 p-3 text-center" style="width: 100%">
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
    <div class="modal fade" id="countryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="countryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="countryModalLabel">Add Country</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form id="countryForm" action="{{ route('admin.new.country') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">New Country Name:</label>
                            <input type="text" class="form-control" id="name" name="name">
                            <input type="hidden" name="oldName" id="oldName">

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
        var countries = @json($countries);
        console.log(countries);

        function confirmDelete(id) {
            var confirmDelete = confirm("¿Are your sure to delete the country with ID " + id + "?");
            if (confirmDelete) {

                window.location.href = "{{ route('admin.delete.country', ['id' => ':id']) }}".replace(':id', id);
            }
        }

        $(document).ready(function() {

            $('#submitButton').click(function() {
                $('#countryForm').submit();

            });


            $('#cancel').click(function() {

                $('#oldName').attr('value', null);
            });


            $('#countryTable').on('click', '.modalAction', function() {
                var countryName = $(this).data('name-country');
                $('#name').val(countryName);
                $('#submitButton').text('Update');
                $('#countryModalLabel').text('Edit country');
                $('#oldName').attr('value', countryName);


            });

            $('#countryTable').on('click', '.btn-delete', function() {
                var id = $(this).data('id-country');
                confirmDelete(id);
            });



            var table = $('#countryTable')
                .DataTable({
                    dom: 'Bfrtip',
                    select: true,
                    data: countries,
                    responsive: true,
                    columns: [{
                            data: 'id_country'
                        },

                        {
                            data: 'name'
                        },


                        {
                            data: 'name',
                            orderable: false,
                            render: function(data, type, row) {
                                return '<div div class="d-flex justify-content-around">' +
                                    '<button class="btn btn-primary btn-sm m-1 modalAction" data-bs-toggle="modal" data-bs-target="#countryModal" type="button" id="edit" data-name-country="' +
                                    data + '"><i class="fa fa-edit fa-lg"></i></button>' +
                                    '<button class="btn btn-danger btn-sm m-1 btn-delete" data-id-country="' +
                                    row.id_country +
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
