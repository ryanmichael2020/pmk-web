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
                    <h1>Employer Management</h1>
                </div>

                <div class="card-body px-0">
                    <table id="tbl_employers" class="table table-flush table-hover" style="width: 100%">
                        <thead class="thead-light">
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
    @include('shared.datatables_js')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#tbl_employers').DataTable({
                processing: true,
                serverSide: true,
                language: {
                    paginate: {
                        previous: "<i class='fas fa-angle-left'>",
                        next: "<i class='fas fa-angle-right'>"
                    }
                },
                ajax: {
                    url: "/employers/datatable",
                    "dataType": "json",
                    "type": "GET",
                },
                columns: [
                    {data: 'employer.id', name: 'employer.id',},
                    {
                        data: null,
                        render: function (data, type, row) {
                            return row.user_detail.first_name + ' ' + row.user_detail.last_name;
                        },
                    },
                    {data: 'email', name: 'email',},
                    {data: 'employer.company.contact', name: 'employer.company.contact',},
                    {data: 'created_at', name: 'created_at',},
                    {data: 'updated_at', name: 'updated_at',},
                    {data: 'action', name: 'action', orderable: false,},
                ],
                orderable: true,
            })
        });
    </script>
@endsection
