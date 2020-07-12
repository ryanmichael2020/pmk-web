@extends('layouts.master')

@section('body')
    @include('nav.employee.nav')

    <hr class="my-0 bg-default">
    <div class="bg-primary-dark">
        <div class="container">
            <div class="row pt-3 pb-4 mb-0">
                <div class="col-sm-12 px-0">
                    <h1 class="mb-0 text-white">Add Employee Training</h1>

                    <ol class="breadcrumb breadcrumb-custom px-0">
                        <li class="breadcrumb-item"><a href="/profile">Employee Profile</a></li>
                        <li class="breadcrumb-item"><a href="/profile/trainings/management">Employee Trainings</a></li>
                        <li class="breadcrumb-item"><a href="#">Add Employee Training</a></li>
                    </ol>

                    <div class="mt-4">
                        <a href="/profile/trainings/management" class="btn btn-success">
                            Go Back
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container my-6">
        <div class="row">
            <div class="col-sm-12 col-md-8 col-lg-6 mx-auto">

                <form method="post" action="/profile/trainings/add">
                    {{ csrf_field() }}

                    @include('response_notifiers.response_card')

                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-auto">
                                    <h1 class="mb-0">Add Employee Training</h1>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="form-group">
                                <label for="training">Training</label>
                                <input id="training" name="training" type="text" class="form-control" maxlength="128"
                                       required/>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group mb-lg-0">
                                        <label for="month">Month</label>
                                        <select id="month" name="month" class="form-control">
                                            @for($i = 1; $i <= 12; ++$i)
                                                <option
                                                    value="{{ $i }}">{{ date('F', mktime(0, 0, 0, $i, 1)) }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group mb-0">
                                        <label for="year">Year</label>
                                        <input id="year" name="year" type="text" class="form-control"
                                               minlength="4" maxlength="4" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">
                                Add Training
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection
