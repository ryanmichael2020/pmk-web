@extends('layouts.master')

@section('body')
    @include('nav.nav')

    <div class="container">
        <form method="post" action="/jobpost/create">
            {{ csrf_field() }}

            <div class="col-sm-12 col-lg-6 mx-auto my-6">
                <div class="card">
                    <div class="card-header">
                        <h1>
                            <i class="fas fa-building" style="margin-right: 8px;"></i>
                            Create Job Post
                        </h1>
                    </div>

                    <div class="card-body">
                        <h3>Job Details</h3>
                        <div class="form-group">
                            <label for="position">Position</label>
                            <input id="position" name="position" type="text" class="form-control" maxlength="128"
                                   placeholder="Enter Position" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Job Description</label>
                            <input id="description" name="description" type="text" class="form-control"
                                   maxlength="16"
                                   placeholder="Enter job description" required>
                        </div>
                        <div class="form-group">
                            <label for="max_applicant">Max Applicant</label>
                            <input id="max_applicant" name="max_applicant" type="text" class="form-control"
                                   maxlength="16"
                                   placeholder="Enter max Applicant" required>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary form-control">
                            Create Job Post
                        </button>
                    </div>
                </div>
            </div>

        </form>
    </div>
@endsection
