@extends('layouts.master')

@section('body')
    @include('nav.employee.nav')

    <hr class="my-0 bg-default">
    <div class="bg-primary-dark">
        <div class="container">
            <div class="row pt-3 pb-4 mb-0">
                <div class="col-sm-12">
                    <h1 class="mb-0 text-white">Job Offers</h1>

                    <ol class="breadcrumb breadcrumb-custom px-0">
                        <li class="breadcrumb-item"><a href="#">Job Offers</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container my-4">
        <div class="row">

            <div class="col-sm-12 col-md-10 col-lg-8">
                @include('response_notifiers.response_card')

                @if(count($job_offers) > 0)
                    @foreach($job_offers as $job_offer)
                        <div class="card my-2">
                            <div class="card-header">
                                <div class="d-flex">
                                    <h2 class="mb-0 my-auto flex-grow-1">{{ $job_offer->jobPostApplication->jobPost->position }}</h2>

                                    <span class="mb-0 pr-2 my-auto" data-toggle="tooltip"
                                          data-placement="right" title="{{ $job_offer->created_at }}">
                                        Received {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $job_offer->created_at)->diffForHumans() }}
                                    </span>
                                </div>
                            </div>

                            <div class="card-body">
                                <p class="mb-0">
                                    Job Offer Details
                                </p>

                                <hr class="my-2">

                                <p class="mb-0" style="font-size: 14px;">
                                    {{ $job_offer->description }}
                                </p>

                                <p class="mt-4 mb-0">
                                    Job offer expires on
                                </p>
                                <span class="mb-0 text-orange pr-2" data-toggle="tooltip"
                                      data-placement="right" title="{{ $job_offer->date_due }}">
                                    {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $job_offer->date_due)->format('F d, Y h:i A') }}
                                </span>
                            </div>

                            <div class="card-footer">
                                @if($job_offer->isAccepted())
                                    <p class="mb-0 text-success">
                                        You have accepted this job offer.
                                    </p>
                                @elseif($job_offer->isRejected())
                                    <p class="mb-0 text-danger">
                                        You have rejected this job offer.
                                    </p>
                                @endif

                                @if($job_offer->isAcceptable())
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#accept_job_offer_{{ $job_offer->id }}">
                                        Accept Job Offer
                                    </button>
                                @endif

                                @if($job_offer->isRejectable())
                                    <button type="button" class="btn btn-danger" data-toggle="modal"
                                            data-target="#reject_job_offer_{{ $job_offer->id }}">
                                        Reject Job Offer
                                    </button>
                                @endif
                            </div>
                        </div>

                        {{-- Accept Job Offer Modal --}}
                        <div class="modal fade" id="accept_job_offer_{{ $job_offer->id }}" tabindex="-1" role="dialog"
                             aria-labelledby="accept_job_offer_{{ $job_offer->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h2 class="modal-title">Accept Job Offer</h2>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="mb-0">
                                            Are you sure you want to accept this job offer?
                                        </p>
                                    </div>
                                    <div class="modal-footer">
                                        <form method="post" action="/job_offer/accept">
                                            {{ csrf_field() }}

                                            <input name="employee_id" type="hidden"
                                                   value="{{ auth()->user()->employee->id }}">
                                            <input name="job_offer_id" type="hidden" value="{{ $job_offer->id }}">

                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                            </button>
                                            <button type="submit" class="btn btn-success">Accept Job Offer</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Reject Job Offer Modal --}}
                        <div class="modal fade" id="reject_job_offer_{{ $job_offer->id }}" tabindex="-1" role="dialog"
                             aria-labelledby="reject_job_offer_{{ $job_offer->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h2 class="modal-title">Reject Job Offer</h2>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="mb-0">
                                            Are you sure you want to reject this job offer?
                                        </p>
                                    </div>
                                    <div class="modal-footer">
                                        <form method="post" action="/job_offer/reject">
                                            {{ csrf_field() }}

                                            <input name="employee_id" type="hidden"
                                                   value="{{ auth()->user()->employee->id }}">
                                            <input name="job_offer_id" type="hidden" value="{{ $job_offer->id }}">

                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                            </button>
                                            <button type="submit" class="btn btn-danger">Reject Job Offer</button>
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
                                No job offers found.
                            </p>
                        </div>
                    </div>
                @endif
            </div>

        </div>
    </div>
@endsection
