@extends('layouts.master')

@section('body')
    @include('nav.employer.nav')

    <div class="bg-gradient-default">
        <div class="container-fluid">
            <div class="row pt-3 pb-4">
                <div class="col-sm-12 px-0">
                    <div class="mx-4">
                        <h1 class="mb-0 text-white mr-2">Job Offers</h1>

                        <ol class="breadcrumb breadcrumb-custom px-0">
                            <li class="breadcrumb-item"><a href="#">Job Offers</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid px-4">
        <div class="row py-4">

            <div class="order-2 order-lg-1 col-sm-12 col-md-10 order-md-2 order-lg-1 col-lg-8 my-2 mx-auto">
                @include('response_notifiers.response_card')

                @if(count($job_offers) > 0)
                    @foreach($job_offers as $job_offer)
                        <div class="card my-2">
                            <div class="card-header">
                                <p class="mb-0 text-small">Position</p>
                                <a href="/employer/job_post/{{ $job_offer->job_post_id }}">
                                    <h2 class="mb-0">
                                        {{ $job_offer->jobPost->position }}
                                    </h2>
                                </a>
                            </div>

                            <div class="card-header">
                                <div class="d-flex">
                                    <img src="{{ asset($job_offer->employee->user->userDetail->image) }}"
                                         class="avatar rounded-circle mr-2">
                                    <div class="my-auto">
                                        <p class="mb-0">
                                            {{ $job_offer->employee->user->userDetail->name() }}
                                        </p>
                                        <p class="mb-0 text-smaller">
                                            {{ $job_offer->employee->user->email }}
                                        </p>
                                    </div>
                                </div>

                                <a href="/employee/{{ $job_offer->employee_id }}/profile"
                                   class="d-block mt-2 mb-0 text-small">
                                    View Profile
                                </a>

                                <span class="mb-0 text-smaller pr-2" data-toggle="tooltip"
                                      data-placement="right" title="{{ $job_offer->created_at }}">
                                    Submitted
                                    {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $job_offer->created_at)->diffForHumans() }}
                                </span>
                            </div>

                            <div class="card-body">
                                <p class="mb-0">Job Offer Description</p>
                                <p class="mb-0 text-small">
                                    {!! nl2br(e($job_offer->description)) !!}
                                </p>

                                <p class="mt-4 mb-0 text-small">
                                    Status: {{ $job_offer->jobOfferStatus->status }}
                                </p>
                                @if(\Carbon\Carbon::now() < $job_offer->date_due)
                                    <span class="mb-0 text-smaller pr-2" data-toggle="tooltip"
                                          data-placement="right" title="{{ $job_offer->date_due }}">
                                        Expires {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $job_offer->date_due)->diffForHumans() }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="card my-2">
                        <div class="card-body">
                            <p class="mb-0">
                                No job offers sent.
                            </p>
                        </div>
                    </div>
                @endif
            </div>

            <div class="order-1 order-lg-2 col-sm-12 col-md-10 order-md-1 order-lg-2 col-lg-4 my-2 mx-auto">
                <div class="card my-2">
                    <div class="card-header">
                        <h2 class="mb-0">Job Offer Updates</h2>
                    </div>

                    <div class="card-body">
                        @if(count($job_offer_updates) > 0)
                            @foreach($job_offer_updates as $job_offer_update)
                                <div class="bg-transluscent my-2 p-4">
                                    <div class="d-flex">
                                        <div class="flex-grow-1 d-flex">
                                            <img class="avatar rounded-circle mr-2"
                                                 src="{{ asset($job_offer_update->jobOffer->employee->user->userDetail->image) }}">

                                            <div class="mb-2">
                                                <p class="mb-0">
                                                    {{ $job_offer_update->jobOffer->employee->user->userDetail->name() }}
                                                </p>
                                                <p class="mb-0 text-smaller">
                                                    {{ $job_offer_update->jobOffer->employee->user->email }}
                                                </p>
                                            </div>
                                        </div>

                                        <span class="flex-shrink-0 mb-0 text-smaller pr-2" data-toggle="tooltip"
                                              data-placement="right" title="{{ $job_offer_update->created_at }}">
                                            {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $job_offer_update->created_at)->diffForHumans() }}
                                        </span>
                                    </div>

                                    <a href="/employee/{{ $job_offer_update->jobOffer->employee->id }}/profile"
                                       class="text-small">
                                        View Profile
                                    </a>

                                    <p class="mb-0">
                                        {!! nl2br(e($job_offer_update->description)) !!}
                                    </p>
                                </div>
                            @endforeach
                        @else
                            <p class="mb-0">
                                No recent job offer updates
                            </p>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
