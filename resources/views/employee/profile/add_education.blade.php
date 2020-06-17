@extends('layouts.master')

@section('body')
    @include('nav.employee.nav')

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
                                    <a href="/profile/educations/management"
                                       class="btn btn-secondary icon icon-shape rounded-circle">
                                        <i class="fas fa-arrow-left"></i>
                                    </a>
                                </div>

                                <div class="col-auto my-auto">
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

                            <p class="text-orange">
                                * End year can be left empty, if you've stayed for less than a year in the
                                specified school
                            </p>

                            <div class="row">
                                <div class="col-auto">
                                    <div class="form-group">
                                        <label for="start_year">Start Year</label>
                                        <input id="start_year" name="start_year" type="text" class="form-control"
                                               minlength="4" maxlength="4" required>
                                    </div>
                                </div>

                                <div class="col-auto">
                                    <div class="form-group">
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
