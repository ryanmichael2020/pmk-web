@extends('layouts.master')

@section('body')
    @include('nav.employee.nav')

    <div class="row">
        <div class="container">

            <div class="col-sm-12 col-md-10 col-lg-8 mx-auto my-6">
                @include('response_notifiers.response_card')

                <div class="card">
                    <div class="card-header">
                        <h1 class="mb-0">Job Posts</h1>
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
                            <p class="mb-0">
                                Posted by: {{ $job_post->employer->user->userDetail->name() }}
                            </p>
                        </div>

                        <div class="card-body">
                            <p class="mb-0">
                                {{ $job_post->description }}
                            </p>
                        </div>

                        <div class="card-footer">
                            {{ $job_post->employer->company->name }}
                        </div>

                        <div class="card-footer">
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
