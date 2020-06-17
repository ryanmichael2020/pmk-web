@extends('layouts.master')

@section('body')
    @include('nav.employer.nav')

    <div class="container">
        <div class="row">

            <div class="col-sm-12 col-md-10 col-lg-8 mx-auto my-6">
                @include('response_notifiers.response_card')

                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="card-body my-0 py-0 d-flex">
                                <a href="/employer/job_posts" class="btn btn-secondary icon icon-shape rounded-circle">
                                    <i class="fas fa-arrow-left"></i>
                                </a>

                                <h1 class="mb-0 my-auto pl-4">
                                    Job Applications
                                </h1>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <p class="mb-0">
                            Position: {{ $job_post->position }}
                        </p>
                    </div>
                </div>

                @foreach($job_post_applications as $job_post_application)
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    <h2 class="mb-0">{{ $job_post_application->employee->user->userDetail->name() }}</h2>
                                </div>

                                <div class="col-auto my-auto">
                                    <span class="mb-0 pr-2" data-toggle="tooltip" data-placement="right"
                                          title="{{ $job_post_application->jobPost->created_at }}">
                                        {{ \Carbon\Carbon::createFromTimeString($job_post_application->jobPost->created_at)->diffForHumans() }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            {{-- TODO :: Replace with employee profile --}}
                            <p class="mb-0">
                                {{ $job_post_application->jobPost->description }}
                            </p>
                        </div>

                        <div class="card-footer">
                            <p class="mb-0" style="width: auto; flex: fit-content">
                                Date applied:
                                <span class="pr-2" data-toggle="tooltip" data-placement="right"
                                      title="{{ $job_post_application->created_at }}">
                                    {{ \Carbon\Carbon::createFromTimeString($job_post_application->created_at)->diffForHumans() }}
                                </span>
                            </p>
                            <p class="mb-0">
                                Application Status: {{ $job_post_application->jobPostApplicationStatus->status }}
                            </p>
                            <p class="mb-0">
                                Job Post Status: {{ $job_post_application->jobPost->jobPostStatus->status }}
                            </p>
                        </div>

                        <div class="card-footer">
                            @if($job_post_application->reviewable())
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#review_job_application_{{ $job_post_application->id }}">
                                    Place under review
                                </button>
                            @elseif($job_post_application->acceptable())
                                <button type="button" class="btn btn-success" data-toggle="modal"
                                        data-target="#accept_job_application_{{ $job_post_application->id }}">
                                    Accept Applicant
                                </button>
                            @endif

                            @if($job_post_application->cancellable())
                                <button type="button" class="btn btn-warning" data-toggle="modal"
                                        data-target="#cancel_job_application_{{ $job_post_application->id }}">
                                    Cancel Application
                                </button>
                            @else
                                <button type="button" class="btn btn-warning" disabled>
                                    Cancel Application
                                </button>
                            @endif
                        </div>
                    </div>

                    {{-- Modal for placing applicant under review --}}
                    <form method="post" action="/job_application/cancel">
                        {{ csrf_field() }}

                        <input type="hidden" name="job_post_application_id"
                               value="{{ $job_post_application->id }}">

                        <div class="modal fade" id="review_job_application_{{ $job_post_application->id }}"
                             tabindex="-1" role="dialog"
                             aria-labelledby="review_job_application_{{ $job_post_application->id }}"
                             aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h2 class="modal-title mb-0">Review Job Application</h2>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body py-0">
                                        <p class="mb-0">
                                            Are you sure you want to place this applicant under review?
                                        </p>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                        </button>
                                        <button type="submit" class="btn btn-primary">Place under review</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    {{-- Modal for Cancel Job Post Application --}}
                    <form method="post" action="/job_application/cancel">
                        {{ csrf_field() }}

                        <input type="hidden" name="job_post_application_id"
                               value="{{ $job_post_application->id }}">

                        <div class="modal fade" id="cancel_job_application_{{ $job_post_application->id }}"
                             tabindex="-1" role="dialog"
                             aria-labelledby="cancel_job_application_{{ $job_post_application->id }}"
                             aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h2 class="modal-title mb-0">Cancel Job Application</h2>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body py-0">
                                        <p class="mb-0">
                                            Are you sure you want to cancel your job application for the
                                            position {{ $job_post_application->jobPost->position }}
                                        </p>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                        </button>
                                        <button type="submit" class="btn btn-danger">Cancel Application</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                @endforeach
            </div>

        </div>
    </div>
@endsection
