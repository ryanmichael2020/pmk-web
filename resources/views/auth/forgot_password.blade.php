@extends('layouts.master')

@section('body')
    <div class="row" style="padding: 0px; margin: 0px;">
        <div class="container d-flex h-100vh">

            <div class="col-sm-12 col-md-8 col-lg-6 mx-auto my-auto">

                @include('response_notifiers.response_card')

                <form method="post" action="/forgot-password">
                    {{ csrf_field() }}

                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-sm-12 col-md-auto text-center">
                                    <img src="{{ asset('/old/pesologo.png') }}" style="height: 64px; width: 64px; ">
                                </div>

                                <div class="col-md-auto my-auto">
                                <span
                                    style="font-size: 24px; font-weight: bold">{{ config('app.name') }}
                                    Online Platform
                                </span>
                                </div>
                            </div>
                        </div>

                        <div class="card-header">
                            <div class="row h-100">
                                <div class="col-md-auto my-auto">
                                    <a href="/login" class="btn btn-secondary icon icon-shape rounded-circle">
                                        <i class="fas fa-arrow-left fa-2x"></i>
                                    </a>
                                </div>

                                <div class="col-md-auto my-auto">
                                    <h1 class="my-auto">Reset Password</h1>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="form-group mb-0">
                                <label for="email">Email</label>
                                <input id="email" name="email" type="text" class="form-control" maxlength="255"
                                       placeholder="Enter email" required>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary form-control">
                                Send Password Reset Link
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
