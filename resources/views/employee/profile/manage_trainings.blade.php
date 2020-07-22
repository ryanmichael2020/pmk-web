@extends('layouts.master')

@section('body')
    @include('nav.employee.nav')

    <hr class="my-0 bg-default">
    <div class="bg-primary-dark">
        <div class="container">
            <div class="row pt-3 pb-4 mb-0">
                <div class="col-sm-12 px-0">
                    <h1 class="mb-0 text-white">Employee Trainings</h1>

                    <ol class="breadcrumb breadcrumb-custom px-0">
                        <li class="breadcrumb-item"><a href="/profile">Employee Profile</a></li>
                        <li class="breadcrumb-item"><a href="#">Employee Trainings</a></li>
                    </ol>

                    <div class="mt-4">
                        <a href="/profile" class="btn btn-primary">
                            Go Back
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container my-6">
        <div class="row">
            <div class="col-sm-12 mx-auto">

                @include('response_notifiers.response_card')

                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-auto">
                                <h1 class="mb-0">Employee Trainings</h1>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @if(count($employee_trainings) > 0)
                            <ul class="list-group">
                                @foreach($employee_trainings as $employee_training)
                                    <li class="list-group-item my-2">
                                        <div class="row">
                                            <div class="col-sm-12 col-lg-4">
                                                <strong>Training</strong>
                                                <p class="mb-0">{{ $employee_training->training }}</p>
                                            </div>

                                            <div class="col-sm-12 col-lg-4">
                                                <strong>Date</strong>
                                                <p class="mb-0">
                                                    {{ $employee_training->trainingSimpleDate() }}
                                                </p>
                                            </div>

                                            <div style="position: absolute; top: -12px; right: -12px;">
                                                {{-- TODO:: Add a delete modal --}}
                                                <a href="#" class="btn bg-red icon icon-shape rounded-circle">
                                                    <i class="fas fa-trash text-white"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <strong>Training</strong>
                                        <p>-</p>
                                    </div>

                                    <div class="col-sm-12 col-md-3">
                                        <strong>Date</strong>
                                        <p>-</p>
                                    </div>
                                </div>
                                {{-- <span class="badge badge-primary badge-pill">14</span> --}}
                            </li>
                        @endif
                    </div>

                    <div class="card-footer">
                        <a href="/profile/trainings/add">
                            <button type="button" class="btn btn-primary">
                                Add Training
                            </button>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
