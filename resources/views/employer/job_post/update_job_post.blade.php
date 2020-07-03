@extends('layouts.master')

@section('body')
    @include('nav.employer.nav')

    <hr class="my-0 bg-default">
    <div class="bg-primary-dark">
        <div class="container">
            <div class="row pt-3 pb-4">
                <div class="col-sm-12 px-0">
                    <div class="d-flex mx-4">
                        <h1 class="mb-0 text-white mr-2">Job Posts</h1>
                        <a href="/employer/job_post/create" class="btn btn-primary mx-2 my-auto">
                            Create a job post
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <form method="post" action="/job_post/update">
            <input name="job_post_id" type="hidden" value="{{ $job_post->id }}">

            {{ csrf_field() }}

            <div class="col-sm-12 col-lg-6 mx-auto my-4">
                @include('response_notifiers.response_card')

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
                                <h1 class="mb-0">Update Job Post</h1>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <h3>Job Details</h3>
                        <div class="form-group">
                            <label for="position">Position</label>
                            <input id="position" name="position" type="text" class="form-control" maxlength="128"
                                   placeholder="Enter Position" value="{{ $job_post->position }}" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea id="description" name="description" type="text" class="form-control"
                                      minlength="128" maxlength="8096" placeholder="Enter description" rows="5"
                                      required>{{ $job_post->description }}
                            </textarea>
                        </div>

                        <div class="form-group mb-0">
                            <label for="max_applicants">Max Applicants (minimum of 1)</label>
                            <input id="max_applicants" name="max_applicants" type="text" class="form-control"
                                   minlength="1" maxlength="3" placeholder="Enter max applicants (e.g. 1)"
                                   min="1" value="{{ $job_post->max_applicants }}" required>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn bg-orange text-white form-control">
                            Update Job Post
                        </button>
                    </div>
                </div>
            </div>

        </form>
    </div>
@endsection
