@extends('layouts.master')

@section('body')
    @include('nav.employee.nav')

    <hr class="my-0 bg-default">
    <div class="bg-primary-dark">
        <div class="container">
            <div class="row pt-3 pb-4 mb-0">
                <div class="col-sm-12 px-0">
                    <h1 class="mb-0 text-white">Job Posts</h1>
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
                            <p class="mb-0" style="font-size: 12px;">
                                Posted by: {{ $job_post->employer->user->userDetail->name() }}
                            </p>
                        </div>

                        <div class="card-body">
                            <p class="mb-0">
                                {{ $job_post->description }}
                            </p>
                        </div>

                        <div class="card-footer">
                            <div class="row">
                                <div class="col my-auto">
                                    {{ $job_post->employer->company->name }}
                                </div>

                                <div class="col text-right">
                                    @if($job_post->hasApplication(auth()->user()->employee->id))
                                        <span data-toggle="tooltip"
                                              data-placement="right" title="You have already applied for this position">
                                    <button type="button" class="btn btn-primary mr-2" disabled>
                                        Apply for Position
                                    </button>
                                </span>
                                    @else
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#submit_application_{{ $job_post->id }}">
                                            Apply for Position
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="submit_application_{{ $job_post->id }}" tabindex="-1" role="dialog"
                         aria-labelledby="submit_application_{{ $job_post->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h2 class="modal-title">Apply for Position</h2>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p class="mb-0">
                                        Are you sure you want to apply for the position <b>{{ $job_post->position }}</b>?
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <form method="post" action="/job_posts/apply">
                                        {{ csrf_field() }}

                                        <input name="employee_id" type="hidden"
                                               value="{{ auth()->user()->employee->id }}">
                                        <input name="job_post_id" type="hidden" value="{{ $job_post->id }}">

                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                        </button>
                                        <button type="submit" class="btn btn-success">Apply</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

        </div>
    </div>
@endsection
