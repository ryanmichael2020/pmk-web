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
        <div class="row">

            <div class="col-sm-12 col-md-10 col-lg-8 mx-auto my-4">

                @include('response_notifiers.response_card')

                @foreach($job_posts as $job_post)
                    <div class="card my-2" style="border-radius: 0px">
                        <div class="card-header">
                            <div class="d-flex">
                                <h2 class="mb-0 flex-grow-1">{{ $job_post->position }}</h2>

                                <span class="mb-0 my-auto mx-4 pr-2" data-toggle="tooltip" data-placement="right"
                                  title="{{ $job_post->created_at }}">
                                    {{ \Carbon\Carbon::createFromTimeString($job_post->created_at)->diffForHumans() }}
                                </span>

                                <a href="/employer/job_post/update/{{ $job_post->id }}" class="my-auto text-orange">
                                    <i class="fas fa-edit"></i>
                                </a>
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
