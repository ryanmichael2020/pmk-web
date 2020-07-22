@extends('layouts.master')

@section('body')
    <div class="row" style="padding: 0px; margin: 0px;">
        <div class="container">

            <div class="col-12 my-4">

                <div class="card my-2">
                    <div class="card-header d-flex">
                        <img src="{{ asset('/old/pesologo.png') }}" style="height: 64px; width: 64px; ">

                        <h2 class="mb-0 ml-2 my-auto">
                            Email Verification
                        </h2>
                    </div>

                    <div class="card-body">
                        @include('response_notifiers.response_card')
                    </div>

                    <div class="card-footer">
                        <a href="/login" class="btn btn-primary">
                            Login
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
