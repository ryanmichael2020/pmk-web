@extends('layouts.master')

@section('body')
    @include('nav.nav')

    <div class="container">
        <form method="post" action="/employers/create" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="col-sm-12 col-lg-10 mx-auto my-6">

                @include('response_notifiers.response_card')

                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-auto">
                                <a href="/admin/management/employers"
                                   class="btn btn-secondary icon icon-shape rounded-circle">
                                    <i class="fas fa-arrow-left"></i>
                                </a>
                            </div>

                            <div class="col-auto my-auto">
                                <h1 class="mb-0">
                                    <i class="fas fa-user-tie" style="margin-right: 8px;"></i>
                                    Create Employer
                                </h1>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 col-lg-6">
                                <h3>User Credentials</h3>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input id="email" name="email" type="text" class="form-control" maxlength="255"
                                           placeholder="Enter email" required>
                                </div>

                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input id="password" name="password" type="password" class="form-control"
                                           maxlength="32"
                                           placeholder="Enter password" required>
                                </div>

                                <div class="form-group">
                                    <label for="verify_password">Verify Password</label>
                                    <input id="verify_password" name="verify_password" type="password"
                                           class="form-control"
                                           placeholder="Re-enter password" maxlength="32" required>
                                </div>
                            </div>

                            <div class="col-sm-12 col-lg-6">
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

                                <div class="form-group">
                                    <label for="sex">Sex</label>
                                    <select id="sex" name="sex" class="form-control">
                                        <option>Male</option>
                                        <option>Female</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="file" name="image" id="image" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="company_id">Company</label>
                                    <select id="company_id" name="company_id" class="form-control">
                                        @foreach($companies as $company)
                                            @if(old('company_id') != null)
                                                @if(old('company_id') == $company->id)
                                                    <option value="{{ $company->id }}"
                                                            selected>{{ ucfirst($company->name) }}</option>
                                                @else
                                                    <option
                                                        value="{{ $company->id }}">{{ ucfirst($company->name) }}</option>
                                                @endif
                                            @else
                                                <option
                                                    value="{{ $company->id }}">{{ ucfirst($company->name) }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary form-control"
                                @if(count($companies) < 1) disabled @endif>
                            Create Employer
                        </button>
                    </div>
                </div>

            </div>
        </form>
    </div>
@endsection
