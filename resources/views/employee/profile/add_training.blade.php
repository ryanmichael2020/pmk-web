@extends('layouts.master')

@section('body')
    @include('nav.employee.nav')

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
                                    <a href="/profile/trainings/management"
                                       class="btn btn-secondary icon icon-shape rounded-circle">
                                        <i class="fas fa-arrow-left"></i>
                                    </a>
                                </div>

                                <div class="col-auto my-auto">
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
                                    <div class="form-group">
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
                                    <div class="form-group">
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
