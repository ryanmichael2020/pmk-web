@extends('layouts.master')

@section('body')
    @include('nav.employee.nav')

    <hr class="my-0 bg-default">
    <div class="bg-primary-dark">
        <div class="container">
            <div class="row pt-3 pb-4 mb-0">
                <div class="col-sm-12 px-0">
                    <h1 class="mb-0 text-white">Employee Education</h1>

                    <ol class="breadcrumb breadcrumb-custom px-0">
                        <li class="breadcrumb-item"><a href="/profile">Employee Profile</a></li>
                        <li class="breadcrumb-item"><a href="/profile/educations/management">Employee Education</a></li>
                        <li class="breadcrumb-item"><a href="#">Add Employee Education</a></li>
                    </ol>

                    <div class="mt-4">
                        <a href="/profile/educations/management" class="btn btn-success">
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

                <form method="post" action="/profile/education/add">
                    {{ csrf_field() }}

                    @include('response_notifiers.response_card')

                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-auto">
                                    <h1 class="mb-0">Add Employee Education</h1>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="form-group">
                                <label for="school">School</label>
                                <input id="school" name="school" type="text" class="form-control" maxlength="128"
                                       required/>
                            </div>

                            <div class="form-group">
                                <label for="education_level_id">
                                    Education Level
                                </label>
                                <select id="education_level_id" name="education_level_id" class="form-control">
                                    @foreach(\App\Models\Education\EducationLevel::all() as $educationLevel)
                                        <option value="{{ $educationLevel->id }}">{{ $educationLevel->level }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <p class="text-orange pr-6" style="font-size: 12px;">
                                * End year can be left empty, if you've stayed for less than a year in the
                                specified school
                            </p>

                            <div class="row">
                                <div class="col-auto">
                                    <div class="form-group mb-lg-0">
                                        <label for="start_year">Start Year</label>
                                        <input id="start_year" name="start_year" type="text" class="form-control"
                                               minlength="4" maxlength="4" required>
                                    </div>
                                </div>

                                <div class="col-auto">
                                    <div class="form-group mb-0">
                                        <label for="end_year">End Year (Optional)</label>
                                        <input id="end_year" name="end_year" type="text" class="form-control" maxlength="4">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">
                                Add Education
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection
