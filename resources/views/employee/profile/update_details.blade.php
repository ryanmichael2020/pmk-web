@extends('layouts.master')

@section('body')
    @include('nav.employee.nav')

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
                                    <a href="/profile" class="btn btn-secondary icon icon-shape rounded-circle">
                                        <i class="fas fa-arrow-left"></i>
                                    </a>
                                </div>

                                <div class="col-auto my-auto">
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

                            <div class="form-group">
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
