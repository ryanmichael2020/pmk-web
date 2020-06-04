@extends('layouts.master')

@section('body')
    @include('nav.employee_nav')

    <div class="container my-6">
        <div class="row">

            <div class="col-sm-12 col-md-8 col-lg-6 mx-auto">

                {{-- Account --}}
                <div class="card">
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
                        <strong>Email</strong>
                        <p>{{ auth()->user()->email }}</p>

                        <strong>Name</strong>
                        <p>{{ auth()->user()->userDetail->name() }}</p>

                        <strong>Sex</strong>
                        <p>{{ auth()->user()->userDetail->sex }}</p>
                    </div>
                </div>

                {{-- Details --}}
                <div class="card">
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
                        <strong>Age</strong>
                        <p> {{ auth()->user()->employee->age != null ? auth()->user()->employee->age : "-" }}</p>

                        <strong>Address</strong>
                        <p> {{ auth()->user()->employee->address != null ? auth()->user()->employee->address : "-" }}</p>

                        <strong>Mobile</strong>
                        <p> {{ auth()->user()->employee->mobile != null ? auth()->user()->employee->mobile : "-" }}</p>
                    </div>
                </div>

                {{-- Education --}}
                <div class="card">
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
                            @if(auth()->user()->employee->employeeEducations != null)
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
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-auto">
                                <h1 class="my-0">Skills</h1>
                            </div>

                            <div class="col-auto ml-auto my-auto">
                                <a href="#">
                                    <i class="fas fa-edit float-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @if(auth()->user()->employeeSkills != null)
                            @foreach(auth()->user()->employeeSkills as $employeeSkill)
                                <span class="badge badge-pill badge-default"
                                      style="font-size: 14px;">{{ $employeeSkill->skill }}</span>
                            @endforeach
                        @else
                            <span class="badge badge-pill badge-default" style="font-size: 14px;">None</span>
                        @endif
                    </div>
                </div>

                {{-- Trainings --}}
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-auto">
                                <h1 class="my-0">Education</h1>
                            </div>

                            <div class="col-auto ml-auto my-auto">
                                <a href="#">
                                    <i class="fas fa-edit float-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <ul class="list-group">
                            @if(auth()->user()->employeeTrainings != null)
                                @foreach(auth()->user()->employeeTrainings as $employeeTraining)
                                    <li class="list-group-item">
                                        <strong>Training</strong>
                                        <p>{{ $employeeTraining->training }}</p>

                                        <strong>Date</strong>
                                        <p>{{ $employeeTraining->trainingSimpleDate() }}</p>
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
