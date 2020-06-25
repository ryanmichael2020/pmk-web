@extends('layouts.master')

@section('body')
    @include('nav.employer.nav')

    <div class="container">
        <div class="row">

            <div class="col-sm-12 col-md-8 col-lg-6 mx-auto my-6">

                @include('response_notifiers.response_card')

                <form method="post" action="/job_posts/create">
                    {{ csrf_field() }}

                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-auto">
                                    <a href="/employer/job_posts"
                                       class="btn btn-secondary icon icon-shape rounded-circle">
                                        <i class="fas fa-arrow-left"></i>
                                    </a>
                                </div>

                                <div class="col-auto my-auto">
                                    <h1 class="mb-0">Create Job Post</h1>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="form-group">
                                <label for="Position">Position</label>
                                <input id="position" name="position" type="text" class="form-control" maxlength="128"
                                       placeholder="Enter position" required/>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea id="description" name="description" class="form-control" minlength="128"
                                          maxlength="8096" placeholder="Enter description" rows="5" required></textarea>
                            </div>

                            <div class="form-group mb-0">
                                <label for="max_applicants">Max Applicants (minimum of 1)</label>
                                <input id="max_applicants" name="max_applicants" type="number" class="form-control"
                                       min="1" minlength="1" maxlength="3" placeholder="Enter max applicants (e.g. 1)"
                                       required/>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">
                                Create
                            </button>
                        </div>
                    </div>
                </form>

            </div>

        </div>
    </div>
@endsection
