@extends('layouts.master')

@section('body')
    @include('nav.employer.nav')

    <div class="container">
        <div class="row">

            <div class="col-sm-12 col-md-10 col-lg-8 mx-auto my-6">

                @include('response_notifiers.response_card')

                <div class="card">
                    <div class="card-header">
                        <h1 class="mb-0">Job Posts</h1>
                    </div>
                    <div class="card-footer">
                        <a href="/employer/job_post/create">
                            Create a job post
                        </a>
                    </div>
                </div>

                @foreach($job_posts as $job_post)
                    <div class="card mb-0" style="border-radius: 0px">
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
                            <p class="mr-4">
                                <b>Max Applicants:</b> {{ $job_post->max_applicants }}
                            </p>
                            <p class="mr-4 mb-0">
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
