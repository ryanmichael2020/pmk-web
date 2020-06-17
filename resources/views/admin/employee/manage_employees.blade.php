@extends('layouts.master')

@section('header')
    @include('shared.datatables_css')
@endsection

@section('body')
    @include('nav.nav')

    <div class="container-fluid">
        <div class="my-4">

            @include('response_notifiers.response_card')

            <div class="card">
                <div class="card-header">
                    <h1>Employee Management</h1>
                </div>

                <div class="card-body px-0">
                    <table id="tbl_employees" class="table table-flush table-hover" style="width: 100%">
                        <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Sex</th>
                            <th>Mobile</th>
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
    @include('shared.datatables_js')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#tbl_employees').DataTable({
                processing: true,
                serverSide: true,
                language: {
                    paginate: {
                        previous: "<i class='fas fa-angle-left'>",
                        next: "<i class='fas fa-angle-right'>"
                    }
                },
                ajax: {
                    url: "/employees/datatable",
                    "dataType": "json",
                    "type": "GET",
                },
                columns: [
                    {data: 'employee.id', name: 'employee.id',},
                    {
                        data: null,
                        render: function (data, type, row) {
                            return row.user_detail.first_name + ' ' + row.user_detail.last_name;
                        },
                    },
                    {
                        data: null,
                        render: function (data, type, row) {
                            return (row.employee.age != null) ? row.employee.age : 'N/A';
                        },
                    },
                    {data: 'user_detail.sex', name: 'user_detail.sex',},
                    {
                        data: null,
                        render: function (data, type, row) {
                            return (row.employee.mobile != null) ? row.employee.mobile : 'N/A';
                        },
                    },
                    {data: 'created_at', name: 'created_at',},
                    {data: 'updated_at', name: 'updated_at',},
                    {data: 'action', name: 'action', orderable: false,},
                ],
                orderable: true,
            })
        });
    </script>
@endsection