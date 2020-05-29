@extends('layouts.master')

@section('body')
    <div class="row" style="padding: 0px; margin: 0px;">
        <div class="container d-flex h-100vh">

            <div class="col-sm-12 col-md-8 col-lg-6 mx-auto my-auto">
                <form method="post" action="/signup">
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
                                    <a href="/" class="btn btn-secondary icon icon-shape rounded-circle">
                                        <i class="fas fa-arrow-left fa-2x"></i>
                                    </a>
                                </div>

                                <div class="col-md-auto">
                                    <h1>User Signup</h1>
                                    Already have an account?
                                    <a href="/login">Sign in</a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <h3>User Credentials</h3>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" name="email" type="text" class="form-control" maxlength="255"
                                       placeholder="Enter email" required>
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input id="password" name="password" type="password" class="form-control" maxlength="32"
                                       placeholder="Enter password" required>
                            </div>

                            <div class="form-group">
                                <label for="verify_password">Verify Password</label>
                                <input id="verify_password" name="verify_password" type="password" class="form-control"
                                       placeholder="Re-enter password" maxlength="32" required>
                            </div>

                            <h3>User Details</h3>
                            <div class="row">
                                <div class="col-sm-12 col-md">
                                    <div class="form-group">
                                        <label for="first_name">First Name</label>
                                        <input id="first_name" name="first_name" type="text" class="form-control"
                                               maxlength="64" placeholder="Enter first name" required>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md">
                                    <div class="form-group">
                                        <label for="last_name">Last Name</label>
                                        <input id="last_name" name="last_name" type="text" class="form-control"
                                               maxlength="32" placeholder="Enter last name" required>
                                    </div>
                                </div>
                            </div>

                            <label for="sex">Sex</label>
                            <select id="sex" name="sex" class="form-control">
                                <option>Male</option>
                                <option>Female</option>
                            </select>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary form-control">
                                Signup
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
