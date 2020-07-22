@extends('layouts.master')

@section('body')
    @if(auth()->user()->user_type_id == \App\Models\User\UserType::$EMPLOYEE)
        @include('nav.employee.nav')
    @elseif(auth()->user()->user_type_id == \App\Models\User\UserType::$EMPLOYER)
        @include('nav.employer.nav')
    @endif

    <hr class="my-0 bg-default">
    <div class="bg-primary-dark">
        <div class="container-fluid">
            <div class="row pt-3 pb-4 mb-0">
                <div class="col-sm-12">
                    <div class="d-flex">
                        <img src="{{ asset($company->image) }}" style="height: 64px; width: 64px;"/>

                        <div class="ml-4">
                            <h1 class="mb-0 text-white">{{ $company->name }}</h1>

                            <p class="mb-0 text-white">
                                Rating: {{ round($company_rating, 2) }}
                            </p>
                        </div>
                    </div>

                    <ol class="breadcrumb breadcrumb-custom px-0">
                        <li class="breadcrumb-item"><a href="#">Company</a></li>
                    </ol>

                    @if(auth()->user()->user_type_id == \App\Models\User\UserType::$EMPLOYER)
                        @if(auth()->user()->employer->company_id == $company->id)
                            <a href="/company/{{ $company->id }}/employees" class="btn btn-secondary mt-2">
                                View Employees
                            </a>
                        @endif
                    @elseif(auth()->user()->user_type_id == \App\Models\User\UserType::$ADMIN)
                        <a href="/company/{{ $company->id }}/employees" class="btn btn-secondary mt-2">
                            View Employees
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid my-4">
        <div class="row">

            @if($can_submit_review)
                <div class="col-sm-12 col-md-10 col-lg-7 order-2 order-lg-1">
                    @include('response_notifiers.response_card')

                    @include('company._company_reviews')
                </div>
            @else
                <div class="col-sm-12 col-md-10 col-lg-8">
                    @include('response_notifiers.response_card')

                    @include('company._company_reviews')
                </div>
            @endif

            @if($can_submit_review)
                <div class="col-sm-12 col-md-10 col-lg-5 order-1 order-lg-2">
                    @include('company._company_create_rating')
                </div>
            @endif

        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            var rating = 0;

            function setRating(setRating) {
                rating = setRating;
                $('#valScore').val(rating);

                for (var i = 1; i <= rating; i++) {
                    $('#rating_' + i).addClass('text-yellow');
                }
            }

            function highlightRating(setRating) {
                for (i = 1; i <= 5; i++) {
                    if (i <= setRating)
                        $('#rating_' + i).addClass('text-yellow');
                    else
                        $('#rating_' + i).removeClass('text-yellow');
                }
            }

            function unhighlightRating() {
                for (var i = 5; i > 0; i--) {
                    if (rating < i)
                        $('#rating_' + i).removeClass('text-yellow');
                    else
                        $('#rating_' + i).addClass('text-yellow');
                }
            }

            $('#rating_1').mouseenter(function () {
                highlightRating(1);
            });
            $('#rating_1').mouseout(function () {
                unhighlightRating();
            });
            $('#rating_1').click(function () {
                setRating(1);
            });

            $('#rating_2').mouseenter(function () {
                highlightRating(2);
            });
            $('#rating_2').mouseout(function () {
                unhighlightRating();
            });
            $('#rating_2').click(function () {
                setRating(2);
            });

            $('#rating_3').mouseenter(function () {
                highlightRating(3);
            });
            $('#rating_3').mouseout(function () {
                unhighlightRating(3);
            });
            $('#rating_3').click(function () {
                setRating(3);
            });

            $('#rating_4').mouseenter(function () {
                highlightRating(4);
            });
            $('#rating_4').mouseout(function () {
                unhighlightRating();
            });
            $('#rating_4').click(function () {
                setRating(4);
            });

            $('#rating_5').mouseenter(function () {
                highlightRating(5);
            });
            $('#rating_5').mouseout(function () {
                unhighlightRating();
            });
            $('#rating_5').click(function () {
                setRating(5);
            });
        });
    </script>
@endsection
