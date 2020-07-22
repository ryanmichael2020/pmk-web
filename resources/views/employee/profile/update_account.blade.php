@extends('layouts.master')

@section('body')
    @include('nav.employee.nav')

    <hr class="my-0 bg-default">
    <div class="bg-primary-dark">
        <div class="container">
            <div class="row pt-3 pb-4 mb-0">
                <div class="col-sm-12 px-0">
                    <h1 class="mb-0 text-white">Update Account</h1>

                    <ol class="breadcrumb breadcrumb-custom px-0">
                        <li class="breadcrumb-item"><a href="/profile">Employee Profile</a></li>
                        <li class="breadcrumb-item"><a href="#">Update Account</a></li>
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
            <div class="col-sm-12 col-md-8 col-lg-6 mx-auto">

                <form method="post" action="/profile/account/update">
                    {{ csrf_field() }}

                    @include('response_notifiers.response_card')

                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-auto">
                                    <h1 class="mb-0">Update Account</h1>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <p class="text-orange mb-0" style="font-size: 12px;">* Updating your email will change your login credentials.</p>

                            <div class="form-group">
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

                            <div class="form-group mb-0">
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
