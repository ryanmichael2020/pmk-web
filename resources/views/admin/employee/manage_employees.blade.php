@extends('layouts.master')

@section('header')
    @include('shared.datatables_css')
@endsection

@section('body')
    <div class="p-4 bg-primary-dark">
        <div class="d-flex">
            <h1 class="text-white my-auto">Employees</h1>
        </div>

        <ol class="breadcrumb breadcrumb-custom px-0">
            <li class="breadcrumb-item"><a href="#">Employee</a></li>
            <li class="breadcrumb-item"><a href="/admin/management/employees">Management</a></li>
        </ol>

        {{--        <div class="mt-4">--}}
        {{--            <a href="/admin/management/companies/create" class="btn btn-success">--}}
        {{--                Create--}}
        {{--            </a>--}}
        {{--        </div>--}}
    </div>

    <div class="container-fluid">
        <div class="my-4">

            @include('response_notifiers.response_card')

            <div class="card">
                <div class="card-body px-0">
                    <div class="table-responsive">
                        <table id="tbl_employees" class="table table-flush table-hover" style="width: 100%">
                            <thead class="thead-light">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Age</th>
                                <th>Sex</th>
                                <th>Mobile</th>
                                <th>Status</th>
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
                        data: 'user_detail.full_name',
                        name: 'user_detail.full_name',
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
                    {
                        data: null,
                        render: function (data, type, row) {
                            return (row.deleted_at === null) ? 'ACTIVE' : 'SUSPENDED';
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
