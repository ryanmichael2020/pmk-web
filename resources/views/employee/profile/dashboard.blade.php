@extends('layouts.master')

@section('body')
    @include('nav.employee.nav')

    <hr class="my-0 bg-default">
    <div class="bg-primary-dark">
        <div class="container">
            <div class="row pt-3 pb-4">
                <div class="col-sm-12 px-0">
                    <h1 class="mb-0 my-auto pl-4 text-white">
                        Employee Profile
                    </h1>
                </div>
            </div>
        </div>
    </div>

    <div class="container my-4">
        <div class="row">

            <div class="col-sm-12">
                @include('response_notifiers.response_card')
            </div>

            @include('nav.employee.profile.quick_links', ['classes' => 'col-sm-12 col-md-4 col-lg-3 mb-4'])

            <div class="col-sm-12 col-md-8 col-lg-9 mx-auto">

                {{-- Account --}}
                <div id="account" class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-auto">
                                <h1 class="my-0">Account</h1>
                            </div>

                            <div class="col-auto ml-auto my-auto">
                                <a href="/profile/account/update">
                                    <i class="fas fa-edit float-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <strong>Email</strong>
                                <p>{{ auth()->user()->email }}</p>
                            </div>

                            <div class="col-sm-12 col-md-6">
                                <strong>Status</strong>
                                <p>{{ (auth()->user()->employee->company_id != null) ? 'Employed' : 'Unemployed' }}</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <strong>Name</strong>
                                <p>{{ auth()->user()->userDetail->name() }}</p>
                            </div>

                            <div class="col-sm-12 col-md-6">
                                <strong>Sex</strong>
                                <p>{{ auth()->user()->userDetail->sex }}</p>
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

                            <div class="col-auto ml-auto my-auto">
                                <a href="/profile/details/update">
                                    <i class="fas fa-edit float-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <strong>Age</strong>
                                <p> {{ auth()->user()->employee->age != null ? auth()->user()->employee->age : "-" }}</p>
                            </div>

                            <div class="col-sm-12 col-md-6">
                                <strong>Mobile</strong>
                                <p> {{ auth()->user()->employee->mobile != null ? auth()->user()->employee->mobile : "-" }}</p>
                            </div>
                        </div>

                        <strong>Address</strong>
                        <p> {{ auth()->user()->employee->address != null ? auth()->user()->employee->address : "-" }}</p>
                    </div>
                </div>

                {{-- Education --}}
                <div id="education" class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-auto">
                                <h1 class="my-0">Education</h1>
                            </div>

                            <div class="col-auto ml-auto my-auto">
                                <a href="/profile/educations/management">
                                    <i class="fas fa-edit float-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <ul class="list-group">
                            @if(count(auth()->user()->employee->employeeEducations) > 0)
                                @foreach(auth()->user()->employee->employeeEducations as $employeeEducation)
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

                            <div class="col-auto ml-auto my-auto">
                                <a href="/profile/skills/update">
                                    <i class="fas fa-edit float-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @if(count(auth()->user()->employee->employeeSkills) > 0)
                            @foreach(auth()->user()->employee->employeeSkills as $employeeSkill)
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

                            <div class="col-auto ml-auto my-auto">
                                <a href="/profile/trainings/management">
                                    <i class="fas fa-edit float-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <ul class="list-group">
                            @if(count(auth()->user()->employee->employeeTrainings) > 0)
                                @foreach(auth()->user()->employee->employeeTrainings as $employeeTraining)
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

                {{-- Employment History --}}
                <div id="employment_history" class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-auto">
                                <h1 class="my-0">Employment History</h1>
                            </div>

                            <div class="col-auto ml-auto my-auto">
                                <a href="#">
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @if(count(auth()->user()->employee->employeeCompanyHistory) > 0)
                            @foreach(auth()->user()->employee->employeeCompanyHistory as $employeeCompanyHistory)
                                <div class="card">
                                    <div class="card-body">
                                        <p class="mb-0">
                                            <b class="h3">{{ $employeeCompanyHistory->jobPost->position }}</b> at
                                            <b class="h3">
                                                <a href="/company/{{ $employeeCompanyHistory->company_id }}">
                                                    {{ $employeeCompanyHistory->company->name }}
                                                </a>
                                            </b>
                                        </p>
                                    </div>
                                    <div class="card-footer">
                                        <p class="mb-0" style="font-size: 14px;">
                                            Date Hired: {{ $employeeCompanyHistory->created_at }}
                                        </p>

                                        @if($employeeCompanyHistory->dismissed_at != null)
                                            <p class="mb-0" style="font-size: 14px;">
                                                Date Dismissed: {{ $employeeCompanyHistory->dismissed_at }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <span class="badge badge-pill badge-default" style="font-size: 14px;">None</span>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
