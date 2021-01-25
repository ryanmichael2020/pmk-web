@extends('layouts.master')

@section('body')
    @include('nav.employer.nav')

    <hr class="my-0 bg-default">
    <div class="bg-primary-dark">
        <div class="container">
            <div class="row pt-3 pb-4">
                <div class="col-sm-12 px-0 pl-4">
                    <h1 class="mb-0 my-auto text-white">
                        Employee Profile
                    </h1>

                    <ol class="breadcrumb breadcrumb-custom px-0">
                        <li class="breadcrumb-item"><a href="#">Employee Profile</a></li>
                    </ol>

                    <div class="mt-4">
                        @if(auth()->user()->user_type_id == \App\Models\User\UserType::$EMPLOYER)
                            <a href="/company/{{ auth()->user()->employer->company_id }}/employees" type="button"
                               class="mt-2 btn btn-primary">
                                Go Back
                            </a>
                        @endif

                        @if(auth()->user()->user_type_id == \App\Models\User\UserType::$EMPLOYER)
                            @if(auth()->user()->employer->company_id == $employee->company_id)
                                <button type="button" class="mt-2 btn btn-danger" data-toggle="modal"
                                        data-target="#dismiss_employee_modal">
                                    Dismiss Employee
                                </button>
                            @endif
                        @elseif(auth()->user()->user_type_id == \App\Models\User\UserType::$ADMIN)
                            @if($employee->company_id != null)
                                <button type="button" class="mt-2 btn btn-danger" data-toggle="modal"
                                        data-target="#dismiss_employee_modal">
                                    Dismiss Employee
                                </button>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Dismiss Employee Modal --}}
    @if(auth()->user()->user_type_id == \App\Models\User\UserType::$ADMIN)
        <form method="post" action="/employee/dismiss">
            {{ csrf_field() }}

            <input type="hidden" name="employee_id"
                   value="{{ $employee->id }}">

            <input type="hidden" name="employer_id"
                   value="0">

            <div class="modal fade" id="dismiss_employee_modal"
                 tabindex="-1" role="dialog"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title mb-0">Dismiss Employee</h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body py-0">
                            <p class="mb-0">
                                Are you sure you want to dismiss this employee?
                            </p>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                            </button>
                            <button type="submit" class="btn btn-danger">Dismiss Employee</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    @elseif(auth()->user()->user_type_id == \App\Models\User\UserType::$EMPLOYER)
        @if(auth()->user()->employer->company_id == $employee->company_id)
            <form method="post" action="/employee/dismiss">
                {{ csrf_field() }}

                <input type="hidden" name="employee_id"
                       value="{{ $employee->id }}">

                <input type="hidden" name="employer_id"
                       value="{{ auth()->user()->employer->id }}">

                <div class="modal fade" id="dismiss_employee_modal"
                     tabindex="-1" role="dialog"
                     aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h2 class="modal-title mb-0">Dismiss Employee</h2>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body py-0">
                                <p class="mb-0">
                                    Are you sure you want to dismiss this employee?
                                </p>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                </button>
                                <button type="submit" class="btn btn-danger">Dismiss Employee</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        @endif
    @endif

    <div class="container my-4">
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
                        @if(count($user->employee->employeeCompanyHistory) > 0)
                            @foreach($user->employee->employeeCompanyHistory as $employeeCompanyHistory)
                                <div class="card">
                                    <div class="card-body">
                                        <p class="mb-0">
                                            <b class="h3">{{ $employeeCompanyHistory->jobPost->position }}</b> at
                                            <b class="h3">
                                                <a href="/company/{{ $employeeCompanyHistory->id }}">
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
