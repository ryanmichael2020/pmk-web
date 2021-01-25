@extends('layouts.master')

@section('body')
    <div class="bg-gradient-default">
        <div class="container-fluid">
            <div class="row pt-3 pb-4">
                <div class="col-sm-12 px-0">
                    <div class="mx-4">
                        <h1 class="mb-0 text-white mr-2">Employee Profile</h1>

                        <ol class="breadcrumb breadcrumb-custom px-0">
                            <li class="breadcrumb-item"><a href="/admin/management/employees">Employees</a></li>
                            <li class="breadcrumb-item"><a href="#">Profile</a></li>
                        </ol>

                        <a href="/admin/management/employees" class="btn btn-primary mx-0 mt-4">
                            Go Back
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid my-4">
        <div class="row">

            <div class="col-sm-12">
                @include('response_notifiers.response_card')
            </div>

            @include('nav.employee.profile.peek_quick_links', ['classes' => 'col-sm-12 col-md-4 col-lg-3 mb-4'])

            <div class="col-sm-12 col-md-8 col-lg-9 mx-auto">

                {{-- Employee --}}
                <div id="employee" class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-auto">
                                <h1 class="my-0">Employee</h1>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <strong>Email</strong>
                                <p>{{ $user->email }}</p>
                            </div>

                            <div class="col-sm-12 col-md-6">
                                <strong>Status</strong>
                                <p>{{ ($user->employee->company_id != null) ? 'Employed' : 'Unemployed' }}</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <strong>Name</strong>
                                <p>{{ $user->userDetail->name() }}</p>
                            </div>

                            <div class="col-sm-12 col-md-6">
                                <strong>Sex</strong>
                                <p>{{ $user->userDetail->sex }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Details --}}
                <div id="details" class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-auto">
                                <h1 class="my-0">Details</h1>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <strong>Age</strong>
                                <p> {{ $user->employee->age != null ? $user->employee->age : "-" }}</p>
                            </div>

                            <div class="col-sm-12 col-md-6">
                                <strong>Mobile</strong>
                                <p> {{ $user->employee->mobile != null ? $user->employee->mobile : "-" }}</p>
                            </div>
                        </div>

                        <strong>Address</strong>
                        <p> {{ $user->employee->address != null ? $user->employee->address : "-" }}</p>
                    </div>
                </div>

                {{-- Education --}}
                <div id="education" class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-auto">
                                <h1 class="my-0">Education</h1>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <ul class="list-group">
                            @if(count($user->employee->employeeEducations) > 0)
                                @foreach($user->employee->employeeEducations as $employeeEducation)
                                    <li class="list-group-item">
                                        <strong>School</strong>
                                        <p>{{ $employeeEducation->school }}</p>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <strong>Level</strong>
                                                <p>{{ $employeeEducation->educationLevel->level }}</p>
                                            </div>

                                            <div class="col-md-6">
                                                <strong>Year</strong>

                                                @if($employeeEducation->end_year != null)
                                                    <p>{{ $employeeEducation->start_year }}
                                                        - {{ $employeeEducation->end_year }}</p>
                                                @else
                                                    <p>{{ $employeeEducation->start_year }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            @else
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <strong>School</strong>
                                            <p>-</p>
                                        </div>

                                        <div class="col-sm-12 col-md-3">
                                            <strong>Level</strong>
                                            <p>-</p>
                                        </div>

                                        <div class="col-sm-12 col-md-3">

                                            <strong>Year</strong>
                                            <p>-</p>
                                        </div>
                                    </div>
                                    {{-- <span class="badge badge-primary badge-pill">14</span> --}}
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>

                {{-- Skills --}}
                <div id="skills" class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-auto">
                                <h1 class="my-0">Skills</h1>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @if(count($user->employee->employeeSkills) > 0)
                            @foreach($user->employee->employeeSkills as $employeeSkill)
                                <span class="badge badge-pill badge-default"
                                      style="font-size: 14px;">{{ $employeeSkill->skill }}</span>
                            @endforeach
                        @else
                            <span class="badge badge-pill badge-default" style="font-size: 14px;">None</span>
                        @endif
                    </div>
                </div>

                {{-- Trainings --}}
                <div id="trainings" class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-auto">
                                <h1 class="my-0">Trainings</h1>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <ul class="list-group">
                            @if(count($user->employee->employeeTrainings) > 0)
                                @foreach($user->employee->employeeTrainings as $employeeTraining)
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6">
                                                <strong>Training</strong>
                                                <p>{{ $employeeTraining->training }}</p>
                                            </div>

                                            <div class="col-sm-12 col-md-6">
                                                <strong>Date</strong>
                                                <p>{{ $employeeTraining->trainingSimpleDate() }}</p>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            @else
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <strong>Training</strong>
                                            <p>-</p>
                                        </div>

                                        <div class="col-sm-12 col-md-6">
                                            <strong>Date</strong>
                                            <p>-</p>
                                        </div>
                                    </div>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
