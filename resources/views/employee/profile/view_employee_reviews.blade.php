@extends('layouts.master')

@section('header')
    <style type="text/css">
        .bootstrap-tagsinput {
            width: 100% !important;
        }

        i.fa-star {
            color: grey;
        }

        i.fa-star:hover {
            cursor: pointer;
        }
    </style>
@endsection

@section('body')
    @if(auth()->user()->user_type_id == \App\Models\User\UserType::$ADMIN)
        @include('nav.nav')
    @elseif(auth()->user()->user_type_id == \App\Models\User\UserType::$EMPLOYER)
        @include('nav.employer.nav')
    @elseif(auth()->user()->user_type_id == \App\Models\User\UserType::$EMPLOYEE)
        @include('nav.employee.nav')
    @endif

    <hr class="my-0 bg-default">
    <div class="bg-primary-dark">
        <div class="container">
            <div class="row pt-3 pb-4 mb-0">
                <div class="col-sm-12 px-0">
                    <h1 class="mb-0 text-white">Employee Reviews</h1>

                    <ol class="breadcrumb breadcrumb-custom px-0">
                        <li class="breadcrumb-item"><a href="/profile">Employee Profile</a></li>
                        <li class="breadcrumb-item"><a href="#">Employee Reviews</a></li>
                    </ol>

                    <div class="mt-4">
                        @if(auth()->user()->user_type_id == \App\Models\User\UserType::$EMPLOYEE)
                            <a href="/profile" class="btn btn-primary">
                                Go Back
                            </a>
                        @else
                            <a href="/employee/1/profile" class="btn btn-primary">
                                Go Back
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container my-4">
        <div class="row">

            <div class="col-sm-12 col-md-8 px-0">

                @include('response_notifiers.response_card')

                @if($can_create_review)
                    @include('employee.profile._create_employee_review')
                @endif

                @if(count($employee_reviews) > 0)
                    @foreach($employee_reviews as $employee_review)
                        <div class="card my-2">
                            <div class="card-header">
                                <div class="d-flex">
                                    <img src="{{ asset($employee_review->company->image) }}"
                                         class="avatar rounded-circle my-auto" style="height: 48px; width: 48px;">

                                    <div class="ml-3 my-auto">
                                        <h2 class="mb-0">
                                            {{ $employee_review->company->name }}
                                        </h2>

                                        <span class="mb-0 pr-2 text-small" data-toggle="tooltip" data-placement="right"
                                              title="{{ $employee_review->created_at }}">
                                            {{ \Carbon\Carbon::createFromTimeString($employee_review->created_at)->diffForHumans() }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                @foreach($employee_review->employeeReviewScores as $employeeReviewScore)
                                    <p class="mb-0">
                                        <label
                                            style="width: 128px;">{{ $employeeReviewScore->employeeReviewType->type }}</label>

                                        @for($i = 0; $i < $employeeReviewScore->score; $i++)
                                            <i class="fas fa-star text-yellow"></i>
                                        @endfor
                                    </p>
                                @endforeach

                                <p class="mb-0">
                                    {{ $employee_review->comment }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="card my-2">
                        <div class="card-body">
                            <p class="mb-0">
                                No reviews found.
                            </p>
                        </div>
                    </div>
                @endif

            </div>

        </div>
    </div>

@endsection

@section('script')
    <script src="{{ asset('/vendor/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            var punctuality_score = 0;
            var performance_score = 0;
            var personality_score = 0;

            // Punctuality Score
            function setpunctuality_score(setpunctuality_score) {
                punctuality_score = setpunctuality_score;
                $('#punctuality_score').val(punctuality_score);

                for (var i = 1; i <= punctuality_score; i++) {
                    $('#punctuality_score_' + i).addClass('text-yellow');
                }
            }

            function highlightpunctuality_score(setpunctuality_score) {
                for (i = 1; i <= 5; i++) {
                    if (i <= setpunctuality_score)
                        $('#punctuality_score_' + i).addClass('text-yellow');
                    else
                        $('#punctuality_score_' + i).removeClass('text-yellow');
                }
            }

            function unhighlightpunctuality_score() {
                for (var i = 5; i > 0; i--) {
                    if (punctuality_score < i)
                        $('#punctuality_score_' + i).removeClass('text-yellow');
                    else
                        $('#punctuality_score_' + i).addClass('text-yellow');
                }
            }

            $('#punctuality_score_1').mouseenter(function () {
                highlightpunctuality_score(1);
            });
            $('#punctuality_score_1').mouseout(function () {
                unhighlightpunctuality_score();
            });
            $('#punctuality_score_1').click(function () {
                setpunctuality_score(1);
            });

            $('#punctuality_score_2').mouseenter(function () {
                highlightpunctuality_score(2);
            });
            $('#punctuality_score_2').mouseout(function () {
                unhighlightpunctuality_score();
            });
            $('#punctuality_score_2').click(function () {
                setpunctuality_score(2);
            });

            $('#punctuality_score_3').mouseenter(function () {
                highlightpunctuality_score(3);
            });
            $('#punctuality_score_3').mouseout(function () {
                unhighlightpunctuality_score(3);
            });
            $('#punctuality_score_3').click(function () {
                setpunctuality_score(3);
            });

            $('#punctuality_score_4').mouseenter(function () {
                highlightpunctuality_score(4);
            });
            $('#punctuality_score_4').mouseout(function () {
                unhighlightpunctuality_score();
            });
            $('#punctuality_score_4').click(function () {
                setpunctuality_score(4);
            });

            $('#punctuality_score_5').mouseenter(function () {
                highlightpunctuality_score(5);
            });
            $('#punctuality_score_5').mouseout(function () {
                unhighlightpunctuality_score();
            });
            $('#punctuality_score_5').click(function () {
                setpunctuality_score(5);
            });

            // Performance Score
            function setperformance_score(setperformance_score) {
                performance_score = setperformance_score;
                $('#performance_score').val(performance_score);

                for (var i = 1; i <= performance_score; i++) {
                    $('#performance_score_' + i).addClass('text-yellow');
                }
            }

            function highlightperformance_score(setperformance_score) {
                for (i = 1; i <= 5; i++) {
                    if (i <= setperformance_score)
                        $('#performance_score_' + i).addClass('text-yellow');
                    else
                        $('#performance_score_' + i).removeClass('text-yellow');
                }
            }

            function unhighlightperformance_score() {
                for (var i = 5; i > 0; i--) {
                    if (performance_score < i)
                        $('#performance_score_' + i).removeClass('text-yellow');
                    else
                        $('#performance_score_' + i).addClass('text-yellow');
                }
            }

            $('#performance_score_1').mouseenter(function () {
                highlightperformance_score(1);
            });
            $('#performance_score_1').mouseout(function () {
                unhighlightperformance_score();
            });
            $('#performance_score_1').click(function () {
                setperformance_score(1);
            });

            $('#performance_score_2').mouseenter(function () {
                highlightperformance_score(2);
            });
            $('#performance_score_2').mouseout(function () {
                unhighlightperformance_score();
            });
            $('#performance_score_2').click(function () {
                setperformance_score(2);
            });

            $('#performance_score_3').mouseenter(function () {
                highlightperformance_score(3);
            });
            $('#performance_score_3').mouseout(function () {
                unhighlightperformance_score(3);
            });
            $('#performance_score_3').click(function () {
                setperformance_score(3);
            });

            $('#performance_score_4').mouseenter(function () {
                highlightperformance_score(4);
            });
            $('#performance_score_4').mouseout(function () {
                unhighlightperformance_score();
            });
            $('#performance_score_4').click(function () {
                setperformance_score(4);
            });

            $('#performance_score_5').mouseenter(function () {
                highlightperformance_score(5);
            });
            $('#performance_score_5').mouseout(function () {
                unhighlightperformance_score();
            });
            $('#performance_score_5').click(function () {
                setperformance_score(5);
            });

            // Personality Score
            function setpersonality_score(setpersonality_score) {
                personality_score = setpersonality_score;
                $('#personality_score').val(personality_score);

                for (var i = 1; i <= personality_score; i++) {
                    $('#personality_score_' + i).addClass('text-yellow');
                }
            }

            function highlightpersonality_score(setpersonality_score) {
                for (i = 1; i <= 5; i++) {
                    if (i <= setpersonality_score)
                        $('#personality_score_' + i).addClass('text-yellow');
                    else
                        $('#personality_score_' + i).removeClass('text-yellow');
                }
            }

            function unhighlightpersonality_score() {
                for (var i = 5; i > 0; i--) {
                    if (personality_score < i)
                        $('#personality_score_' + i).removeClass('text-yellow');
                    else
                        $('#personality_score_' + i).addClass('text-yellow');
                }
            }

            $('#personality_score_1').mouseenter(function () {
                highlightpersonality_score(1);
            });
            $('#personality_score_1').mouseout(function () {
                unhighlightpersonality_score();
            });
            $('#personality_score_1').click(function () {
                setpersonality_score(1);
            });

            $('#personality_score_2').mouseenter(function () {
                highlightpersonality_score(2);
            });
            $('#personality_score_2').mouseout(function () {
                unhighlightpersonality_score();
            });
            $('#personality_score_2').click(function () {
                setpersonality_score(2);
            });

            $('#personality_score_3').mouseenter(function () {
                highlightpersonality_score(3);
            });
            $('#personality_score_3').mouseout(function () {
                unhighlightpersonality_score(3);
            });
            $('#personality_score_3').click(function () {
                setpersonality_score(3);
            });

            $('#personality_score_4').mouseenter(function () {
                highlightpersonality_score(4);
            });
            $('#personality_score_4').mouseout(function () {
                unhighlightpersonality_score();
            });
            $('#personality_score_4').click(function () {
                setpersonality_score(4);
            });

            $('#personality_score_5').mouseenter(function () {
                highlightpersonality_score(5);
            });
            $('#personality_score_5').mouseout(function () {
                unhighlightpersonality_score();
            });
            $('#personality_score_5').click(function () {
                setpersonality_score(5);
            });
        });
    </script>
@endsection
