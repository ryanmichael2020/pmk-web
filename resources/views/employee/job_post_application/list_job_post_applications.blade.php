@extends('layouts.master')

@section('body')
    @include('nav.employee.nav')

    <div class="container">
        <div class="row">

            <div class="col-sm-12 col-md-10 col-lg-8 mx-auto my-6">
                @include('response_notifiers.response_card')

                <div class="card">
                    <div class="card-header">
                        <h1 class="mb-0">
                            Job Applications
                        </h1>
                    </div>
                </div>

                @foreach($job_post_applications as $job_post_application)
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    <h2 class="mb-0">{{ $job_post_application->jobPost->position }}</h2>
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
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
@endsection
