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

    <div class="container-fluid">
        <div class="row py-4">

            <div class="col-sm-12 col-md-10 order-md-2 order-lg-1 col-lg-8 my-2 mx-auto">
                @include('response_notifiers.response_card')

                @if(count($job_offers) > 0)
                    @foreach($job_offers as $job_offer)
                        <div class="card my-2">
                            <div class="card-header">
                                <div class="d-flex">
                                    <img src="{{ asset($job_offer->employee->user->userDetail->image) }}"
                                         class="avatar rounded-circle mr-2">
                                    <div class="my-auto">
                                        <p class="mb-0">
                                            {{ $job_offer->employee->user->userDetail->name() }}
                                        </p>
                                        <p class="mb-0" style="font-size: 12px;">
                                            {{ $job_offer->employee->user->email }}
                                        </p>
                                    </div>
                                </div>

                                <a href="/employee/{{ $job_offer->employee_id }}/profile" class="d-block mt-2 mb-0"
                                   style="font-size: 14px;">
                                    View Profile
                                </a>

                                <span class="mb-0 pr-2" data-toggle="tooltip"
                                      data-placement="right" title="{{ $job_offer->created_at }}" style="font-size: 12px;">
                                    Submitted
                                    <span>
                                        {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $job_offer->created_at)->diffForHumans() }}
                                    </span>
                                </span>
                            </div>

                            <div class="card-body">
                                <p class="mb-0">Job Offer Description</p>
                                <p class="mb-0" style="font-size: 14px;">
                                    {{ $job_offer->description }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <div class="col-sm-12 col-md-10 order-md-1 order-lg-2 col-lg-4 my-2 mx-auto">
                <div class="card my-2">
                    <div class="card-header">
                        <h2 class="mb-0">Job Offer Updates</h2>
                    </div>

                    <div class="card-body">
                        <p class="mb-0">
                            No recent job offer updates
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
