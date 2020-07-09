@extends('layouts.master')

@section('body')
    @include('nav.employee.nav')

    <hr class="my-0 bg-default">
    <div class="bg-primary-dark">
        <div class="container">
            <div class="row pt-3 pb-4 mb-0">
                <div class="col-sm-12 px-0">
                    <h1 class="mb-0 text-white">Update Details</h1>

                    <ol class="breadcrumb breadcrumb-custom px-0">
                        <li class="breadcrumb-item"><a href="/profile">Employee Profile</a></li>
                        <li class="breadcrumb-item"><a href="#">Update Details</a></li>
                    </ol>

                    <div class="mt-4">
                        <a href="/profile" class="btn btn-success">
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

                <form method="post" action="/profile/details/update">
                    {{ csrf_field() }}

                    @include('response_notifiers.response_card')

                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-auto">
                                    <h1 class="mb-0">Update Details</h1>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="form-group">
                                <label for="age">Age</label>
                                <input id="age" name="age" type="text" class="form-control" maxlength="2"
                                       placeholder="Enter age" value="{{ $employee->age }}" required>
                            </div>

                            <div class="form-group">
                                <label for="mobile">Mobile</label>
                                <input id="mobile" name="mobile" type="text" class="form-control" maxlength="16"
                                       placeholder="Enter mobile" value="{{ $employee->mobile }}"
                                       required>
                            </div>

                            <div class="form-group mb-0">
                                <label for="address">Address</label>
                                <input id="address" name="address" type="text" class="form-control" maxlength="512"
                                       placeholder="Enter address" value="{{ $employee->address }}"
                                       required>
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
