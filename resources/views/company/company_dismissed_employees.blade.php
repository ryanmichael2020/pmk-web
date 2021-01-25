@extends('layouts.master')

@section('header')
    @include('shared.datatables_css')
@endsection

@section('body')
    @if(auth()->user()->user_type_id == \App\Models\User\UserType::$EMPLOYEE)
        @include('nav.employee.nav')
    @elseif(auth()->user()->user_type_id == \App\Models\User\UserType::$EMPLOYER)
        @include('nav.employer.nav')
    @endif

    <hr class="my-0 bg-default">
    <div class="bg-primary-dark">
        <div class="container-fluid">
            <div class="row pt-3 pb-4 mb-0">
                <div class="col-sm-12">
                    <div class="d-flex">
                        <img src="{{ asset($company->image) }}" style="height: 64px; width: 64px;"/>

                        <div class="ml-4">
                            <h1 class="mb-0 text-white">{{ $company->name }}</h1>

                            <p class="mb-0 text-white">
                                Rating: {{ round($company_rating, 2) }}
                            </p>
                        </div>
                    </div>

                    <ol class="breadcrumb breadcrumb-custom px-0">
                        <li class="breadcrumb-item"><a href="/company/{{ $company->id }}">Company</a></li>
                        <li class="breadcrumb-item"><a href="#">Employees</a></li>
                    </ol>

                    <a href="/company/{{ $company->id }}" class="btn btn-primary mt-2">
                        Go Back
                    </a>

                    <a href="/company/{{ $company->id }}/employees" class="btn btn-secondary mt-2">
                        View Current Employees
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">

            <div class="col-12 my-4">
                <div class="card my-2">

                    <div class="card-body px-0">
                        <div class="table-responsive">
                            <table id="tbl_employees" class="table table-flush table-hover align-items-center"
                                   style="width: 100%">
                                <thead class="thead-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Status</th>
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
                    url: "/company/{{ $company->id }}/employees/dismissed/datatable",
                    "dataType": "json",
                    "type": "GET",
                },
                columns: [
                    {data: 'employee.id', name: 'employee.id',},
                    {
                        data: null,
                        render: function (data, type, row) {
                            return row.employee.user.user_detail.first_name + ' ' + row.employee.user.user_detail.last_name;
                        },
                    },
                    {
                        data: null,
                        render: function (data, type, row) {
                            if(row.employee.company_id != null)
                                return 'Employed';

                            return 'Unemployed';
                        },
                    },
                    {
                        data: null,
                        render: function (data, type, row) {
                            return (row.employee.age != null) ? row.employee.age : 'N/A';
                        },
                    },
                    {data: 'employee.user.user_detail.sex', name: 'employee.user.user_detail.sex',},
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
