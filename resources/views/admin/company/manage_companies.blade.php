@extends('layouts.master')

@section('header')
    @include('shared.datatables_css')
@endsection

@section('body')
    <div class="p-4 bg-primary-dark">
        <div class="d-flex">
            <h1 class="text-white my-auto">Companies</h1>
        </div>

        <ol class="breadcrumb breadcrumb-custom px-0">
            <li class="breadcrumb-item"><a href="#">Company</a></li>
            <li class="breadcrumb-item"><a href="#">Management</a></li>
        </ol>

        <div class="mt-4">
            <a href="/admin/management/companies/create" class="btn btn-success">
                Create
            </a>
        </div>
    </div>

    <div class="container-fluid">
        <div class="my-4">
            @include('response_notifiers.response_card')

            <div class="card">
                <div class="card-body px-0">
                    <div class="table-responsive">
                        <table id="tbl_companies" class="table table-flush table-hover align-items-center" style="width: 100%">
                            <thead class="thead-light">
                            <tr>
                                <th>Logo</th>
                                <th>ID</th>
                                <th>Name</th>
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
    </div>
@endsection

@section('script')
    @include('shared.datatables_js')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#tbl_companies').DataTable({
                processing: true,
                serverSide: true,
                language: {
                    paginate: {
                        previous: "<i class='fas fa-angle-left'>",
                        next: "<i class='fas fa-angle-right'>"
                    }
                },
                ajax: {
                    url: "/companies/datatable",
                    "dataType": "json",
                    "type": "GET",
                },
                columns: [
                    {
                        data: 'image',
                        name: 'image',
                        render: function (data, type, row) {
                            if (row['image'] != null) {
                                return '<img src="http://{{ request()->getHttpHost()}}' + row['image'] + '" class="rounded-circle" style="width: 48px; height: 48px;"/>';
                            } else {
                                return 'N/A';
                            }
                        },
                    },
                    {data: 'id', name: 'id',},
                    {data: 'name', name: 'type',},
                    {data: 'contact', name: 'contact',},
                    {data: 'created_at', name: 'created_at',},
                    {data: 'updated_at', name: 'updated_at',},
                    {data: 'action', name: 'action', orderable: false,},
                ],
                orderable: true,
            })
        });
    </script>
@endsection
