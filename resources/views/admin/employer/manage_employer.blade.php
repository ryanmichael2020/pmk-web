@extends('layouts.master')

@section('header')
    <link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}" type="text/css">
@endsection

@section('body')
    <div class="container-fluid">
        <div class="my-4">
            <div class="card">
                <div class="card-header">
                    <h1>Company Management</h1>
                </div>

                <div class="card-body">
                    <table id="tbl_employers" class="table" style="width: 100%">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Created</th>
                            <th>Updated</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/datatables.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#tbl_employers').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "/employers/datatable",
                    "dataType": "json",
                    "type": "GET",
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {
                        data: null,
                        render: function (data, type, row) {
                            return row.user_detail.first_name + ' ' + row.user_detail.last_name;
                        }
                    },
                    {data: 'email', name: 'email'},
                    {data: 'employer.company.contact', name: 'employer.company.contact'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'updated_at', name: 'updated_at'},
                    {data: 'action', name: 'action'},
                ],
                orderable: true,
            })
        });
    </script>
@endsection
