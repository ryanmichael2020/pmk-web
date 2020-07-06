@extends('layouts.master')

@section('body')
    @include('nav.employee.nav')

    <div class="container my-4">
        <div class="row">

            <div class="col-sm-12 col-md-10 col-lg-8 mx-auto">
                @include('response_notifiers.response_card')

                <div class="card mb-0">
                    <div class="card-body">
                        <div class="input-group">
                            <input id="txtPosition" type="text" class="form-control" placeholder="Search job..">
                            <div class="input-group-append">
                                <button id="btnSearch" class="btn btn-outline-primary" type="button"
                                        style="height: 46px;">Search
                                </button>
                            </div>

                            @if(request()->query('position') != null)
                                <div id="sectionFilterOptions" class="ml-2 mt-2 my-auto">
                                    <a href="/job_posts" class="avatar btn-primary" style="border-radius: 32px">
                                        <i class="fas fa-backspace" style="font-size: 24px;"></i>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Mobile only recent applications --}}
                <div class="card d-lg-none my-2">
                    <div class="card-header">
                        <h2 class="mb-0">
                            Recent applications
                        </h2>
                    </div>

                    <div class="card-body">
                        @if(count($job_applications) > 0)
                            @foreach($job_applications as $index => $job_application)
                                <a href="#">
                                    <p class="mb-0">
                                        {{ $job_application->jobPost->position }}
                                    </p>
                                </a>
                                <span class="p mb-0" style="font-size: 12px;" data-toggle="tooltip"
                                      data-placement="right"
                                      title="{{ $job_application->jobPost->created_at }}">
                                    Submitted
                                    <span>
                                        {{ \Carbon\Carbon::createFromFormat('Y-m-d h:i:s', $job_application->jobPost->created_at)->diffForHumans() }}
                                    </span>
                                </span>

                                @if($index != (count($job_applications) - 1))
                                    <hr class="my-3">
                                @endif
                            @endforeach
                        @else
                            <p class="mb-0">
                                No recent applications found
                            </p>
                        @endif
                    </div>
                </div>
                {{-- End of mobile only recent applications --}}

                @if(count($job_posts) > 0)
                    @foreach($job_posts as $job_post)
                        <div class="card my-2">
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
                                        <p class="mb-0" style="font-size: 12px;">
                                            Company
                                        </p>
                                        <p class="mb-0">
                                            {{ $job_post->employer->company->name }}
                                        </p>
                                    </div>

                                    <div class="col text-right my-auto">
                                        @if($job_post->hasApplication(auth()->user()->employee->id))
                                            <span data-toggle="tooltip"
                                                  data-placement="right"
                                                  title="You have already applied for this position">
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
                                            Are you sure you want to apply for the position
                                            <b>{{ $job_post->position }}</b>?
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
                @else
                    <div class="card my-2">
                        <div class="card-body">
                            <p class="mb-0">
                                No job posts found
                            </p>
                        </div>
                    </div>
                @endif
            </div>

            <div class="col-sm-12 col-md-10 d-md-none d-lg-inline col-lg-4 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h2 class="mb-0">
                            Recent applications
                        </h2>
                    </div>

                    <div class="card-body">
                        @if(count($job_applications) > 0)
                            @foreach($job_applications as $index => $job_application)

                                {{-- Only display up to 5 items for mobile only view --}}
                                @if($index < 5)
                                    <a href="#">
                                        <p class="mb-0">
                                            {{ $job_application->jobPost->position }}
                                        </p>
                                    </a>
                                    <span class="p mb-0" style="font-size: 12px;" data-toggle="tooltip"
                                          data-placement="right"
                                          title="{{ $job_application->jobPost->created_at }}">
                                        Submitted
                                        <span class="mr-2">
                                            {{ \Carbon\Carbon::createFromFormat('Y-m-d h:i:s', $job_application->jobPost->created_at)->diffForHumans() }}
                                        </span>
                                    </span>
                                @endif

                                @if($index != (count($job_applications) - 1))
                                    <hr class="my-3">
                                @endif
                            @endforeach
                        @else
                            <p class="mb-0">
                                No recent applications found
                            </p>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#btnSearch').on('click', function () {
                var position = $('#txtPosition').val().trim();

                window.location.href = '/job_posts?position=' + position;
            });
        })
    </script>
@endsection
