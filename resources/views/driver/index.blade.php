@extends('layouts.admin')

@section('content')

    <table id="drivers-table" class="table table-condensed" >
        <caption class="alert alert-success">
            <p>
                <strong>IMPORTANT: </strong>When using <strong>make()</strong>, the package will rely filtering and sorting based on the index/arrangement of your select query.
            </p>
            <br>
            <p>
                <strong>NEVER USE SELECT(*)</strong> when using this approach or your DataTables filtering/sorting may not work properly.
            </p>
        </caption>
        <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Image</th>
            <th>Email</th>
            <th>Phone</th>

            <th>Created At</th>
        </tr>
        </thead>
    </table>
    {{--$drivers = $users->pluck("id","name", "image", "email", "phone", "created_at" ,"updated_at");--}}

@endsection
@section('bottom-ext')
    <script>
        $(function () {
            var driversTable = $('#drivers-table').DataTable({
                pageLength: 100,
                processing: true,
                serverSide: true,
                ajax: '{{url("/drivers/getData")}}'
            });


            $('#drivers-table tbody').on('click', 'tr', function () {
                var data = driversTable.row( this ).data();
                location = "{{url('drivers')}}" + "/" + data[0] + "/"
            } );
        });
    </script>
@endsection