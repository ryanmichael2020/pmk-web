@extends('layouts.master')

@section('body')
    @include('nav.employee_nav')

    <div class="container my-6">
        <div class="row">
            <div class="col-sm-12 mx-auto">

                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-auto">
                                <a href="/profile" class="btn btn-secondary icon icon-shape rounded-circle">
                                    <i class="fas fa-arrow-left"></i>
                                </a>
                            </div>

                            <div class="col-auto my-auto">
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
