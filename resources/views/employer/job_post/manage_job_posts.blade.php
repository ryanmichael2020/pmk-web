@extends('layouts.master')

@section('body')
    @include('nav.employer.nav')

    <hr class="my-0 bg-default">
    <div class="bg-primary-dark">
        <div class="container">
            <div class="row pt-3 pb-4">
                <div class="col-sm-12 px-0">
                    <h1 class="mb-0 text-white">Job Posts</h1>
                    <a href="/employer/job_post/create" class="btn btn-primary mt-3">
                        Create a job post
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">

            <div class="col-sm-12 col-md-10 col-lg-8 mx-auto my-4">

                @include('response_notifiers.response_card')

                @foreach($job_posts as $job_post)
                    <div class="card my-2" style="border-radius: 0px">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    <h2 class="mb-0">{{ $job_post->position }}</h2>
                                </div>

                                <div class="col-auto my-auto">
                                    <span class="mb-0 pr-2" data-toggle="tooltip" data-placement="right"
                                          title="{{ $job_post->created_at }}">
                                        {{ \Carbon\Carbon::createFromTimeString($job_post->created_at)->diffForHumans() }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <p>
                                {{ $job_post->description }}
                            </p>
                        </div>

                        <div class="card-footer">
                            <p class="mr-4 mb-0" style="font-size: 14px;">
                                <b>Max Applicants:</b> {{ $job_post->max_applicants }}
                            </p>
                            <p class="mr-4 mb-0" style="font-size: 14px;">
                                <b>Approved Applicants:</b> {{ $job_post->approved_applicants }}
                            </p>
                        </div>

                        <div class="card-footer">
                            <a href="/employer/job_post/{{ $job_post->id }}/applicants" class="btn btn-primary">
                                View Applicants
                            </a>
                        </div>
                    </div>
                @endforeach

            </div>

        </div>
    </div>
@endsection
