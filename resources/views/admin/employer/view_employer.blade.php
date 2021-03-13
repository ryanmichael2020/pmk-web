@extends('layouts.master')

@section('body')
    <div class="p-4 bg-primary-dark">
        <div class="d-flex">
            <h1 class="text-white my-auto">View Employer</h1>
        </div>

        <ol class="breadcrumb breadcrumb-custom px-0">
            <li class="breadcrumb-item"><a href="/admin/management/employers">Employer</a></li>
            <li class="breadcrumb-item"><a href="#">View Employer</a></li>
        </ol>

        <div class="mt-4">
            <a href="/admin/management/employers" class="btn btn-primary">
                Go Back
            </a>

            @if($employer->user->deleted_at == null)
                <a href="/" class="btn btn-danger" data-toggle="modal"
                   data-target="#suspend_user_modal">
                    Suspend Account
                </a>
            @else
                <a href="/" class="btn btn-secondary" data-toggle="modal"
                   data-target="#restore_user_modal">
                    Restore Account
                </a>
            @endif
        </div>
    </div>

    <div class="container-fluid">
        <form method="post" action="/employer/update" enctype="multipart/form-data">
            {{ csrf_field() }}

            <input id="employer_id" name="employer_id" type="hidden" value="{{ $employer->id }}">

            <div class="col-sm-12 col-lg-10 px-0 my-4">

                @include('response_notifiers.response_card')

                <div class="card">
                    <div class="card-header">
                        <h1 class="mb-auto">
                            Employer Details
                        </h1>
                    </div>

                    <div class="card-body">
                        <h3>User Credentials</h3>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" name="email" type="text" class="form-control" maxlength="255"
                                   placeholder="Enter email" value="{{ $employer->user->email }}" disabled>
                        </div>

                        <h3>User Details</h3>
                        <div class="row">
                            <div class="col-sm-12 col-md">
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input id="first_name" name="first_name" type="text" class="form-control"
                                           maxlength="64" placeholder="Enter first name"
                                           value="{{ $employer->user->userDetail->first_name }}" disabled>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md">
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input id="last_name" name="last_name" type="text" class="form-control"
                                           maxlength="32" placeholder="Enter last name"
                                           value="{{ $employer->user->userDetail->last_name }}" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="sex">Sex</label>
                            <select id="sex" name="sex" class="form-control" disabled>
                                <option @if($employer->user->userDetail->sex == 'Male') selected @endif>Male</option>
                                <option @if($employer->user->userDetail->sex == 'Female') selected @endif>Female
                                </option>
                            </select>
                        </div>

                        <div class="form-group mb-0">
                            <label for="company_id">Company</label>
                            <select id="company_id" name="company_id" class="form-control" disabled>
                                <option
                                    value="{{ $employer->company->id }}">{{ ucfirst($employer->company->name) }}</option>
                            </select>
                        </div>
                    </div>

                    @if($employer->user->deleted_at == null)
                        <div class="card-footer">
                            <a href="/admin/management/employer/{{ $employer->id }}/update"
                               class="btn bg-orange text-white">
                                Edit Employer
                            </a>
                        </div>
                    @endif
                </div>

            </div>
        </form>
    </div>

    <form method="post" action="/user/suspend">
        {{ csrf_field() }}
        <input type="hidden" name="user_id" value="{{ $employer->user->id }}">

        <div class="modal fade" id="suspend_user_modal"
             tabindex="-1" role="dialog"
             aria-labelledby="suspend_user_modal"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title mb-0">Suspend Account</h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body py-0">
                        <p class="mb-0">
                            Are you sure you want to suspend this account?
                        </p>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                        </button>
                        <button type="submit" class="btn btn-danger">Suspend Account</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form method="post" action="/user/restore">
        {{ csrf_field() }}
        <input type="hidden" name="user_id" value="{{ $employer->user->id }}">

        <div class="modal fade" id="restore_user_modal"
             tabindex="-1" role="dialog"
             aria-labelledby="restore_user_modal"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title mb-0">Restore Account</h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body py-0">
                        <p class="mb-0">
                            Are you sure you want to restore this account?
                        </p>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                        </button>
                        <button type="submit" class="btn btn-primary">Restore Account</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
