@extends('layouts.master')

@section('body')
    @include('nav.employee.nav')

    <hr class="my-0 bg-default">
    <div class="bg-primary-dark">
        <div class="container">
            <div class="row pt-3 pb-4 mb-0">
                <div class="col-sm-12">
                    <h1 class="mb-0 text-white">Job Applications</h1>

                    <ol class="breadcrumb breadcrumb-custom px-0">
                        <li class="breadcrumb-item"><a href="#">Job Applications</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">

            <div class="col-sm-12 col-md-10 col-lg-8 my-4">
                @include('response_notifiers.response_card')

                @if(count($job_post_applications) > 0)
                    @foreach($job_post_applications as $job_post_application)
                        <div class="card my-2">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col">
                                        <a href="/job_application/{{ $job_post_application->id }}">
                                            <h2 class="mb-0">{{ $job_post_application->jobPost->position }}</h2>
                                        </a>
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
                                <p class="mb-0">
                                    {{ substr($job_post_application->jobPost->description, 0, 125) . '...' }}
                                </p>
                            </div>

                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-12 mx-1 mb-2">
                                        <a href="/company/{{ $job_post_application->jobPost->company_id }}">
                                            <div class="row">
                                                <div class="my-auto mx-2">
                                                    <img class="rounded-circle"
                                                         src="{{ asset($job_post_application->jobPost->company->image) }}"
                                                         style="height: 48px; width: 48px;"/>
                                                </div>

                                                <div class="col my-auto">
                                                    <p class="mb-0" style="font-size: 12px;">
                                                        Company
                                                    </p>

                                                    <p class="mb-0">
                                                        {{ $job_post_application->jobPost->company->name }}
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>

                                <p class="mb-0" style="width: auto; flex: fit-content; font-size: 14px;">
                                    Date applied:
                                    <span class="pr-2" data-toggle="tooltip" data-placement="right"
                                          title="{{ $job_post_application->created_at }}">
                                    {{ \Carbon\Carbon::createFromTimeString($job_post_application->created_at)->diffForHumans() }}
                                </span>
                                </p>
                                <p class="mb-0" style="font-size: 14px;">
                                    Application Status: {{ $job_post_application->jobPostApplicationStatus->status }}
                                </p>
                                <p class="mb-0" style="font-size: 14px;">
                                    Job Post Status: {{ $job_post_application->jobPost->jobPostStatus->status }}
                                </p>
                            </div>

                            <div class="card-footer">
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

                        <form method="post" action="/job_application/update">
                            {{ csrf_field() }}

                            <input type="hidden" name="job_post_application_id"
                                   value="{{ $job_post_application->id }}">

                            <input type="hidden" name="job_post_application_status_id"
                                   value="{{ \App\Models\JobPost\JobPostApplicationStatus::$CANCELLED }}">

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
                @else
                    <div class="card">
                        <div class="card-body">
                            <p class="mb-0">
                                No recent job applications
                            </p>
                        </div>
                    </div>
                @endif
            </div>

        </div>
    </div>
@endsection

