@extends('layouts.master')

@section('body')
    @include('nav.employee.nav')

    <div class="container my-6">
        <div class="row">
            <div class="col-sm-12 col-md-8 col-lg-6 mx-auto">

                <form method="post" action="/profile/account/update">
                    {{ csrf_field() }}

                    @include('response_notifiers.response_card')

                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-auto">
                                    <a href="/profile" class="btn btn-secondary icon icon-shape rounded-circle">
                                        <i class="fas fa-arrow-left"></i>
                                    </a>
                                </div>

                                <div class="col-auto my-auto">
                                    <h1 class="mb-0">Update Account</h1>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="form-group">
                                <p class="text-orange">* Updating your email will change your login credentials.</p>

                                <label for="email">Email</label>
                                <input id="email" name="email" type="text" class="form-control" maxlength="255"
                                       placeholder="Enter email" value="{{ $user->email }}" required>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="first_name">First Name</label>
                                        <input id="first_name" name="first_name" type="text" class="form-control"
                                               maxlength="64"
                                               placeholder="Enter first name"
                                               value="{{ $user->userDetail->first_name }}"
                                               required>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="last_name">Last Name</label>
                                        <input id="last_name" name="last_name" type="text" class="form-control"
                                               maxlength="32"
                                               placeholder="Enter last name" value="{{ $user->userDetail->last_name }}"
                                               required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="sex">Sex</label>
                                <select id="sex" name="sex" class="form-control">
                                    <option @if(auth()->user()->userDetail->sex == 'Male') selected @endif>Male</option>
                                    <option @if(auth()->user()->userDetail->sex == 'Female') selected @endif>Female
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn bg-orange text-white">
                                Update
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
