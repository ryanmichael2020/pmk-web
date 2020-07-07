@extends('layouts.master')

@section('body')
    <div class="p-4 bg-primary-dark">
        <div class="d-flex">
            <h1 class="text-white my-auto">Update Company</h1>
        </div>

        <ol class="breadcrumb breadcrumb-custom px-0">
            <li class="breadcrumb-item"><a href="/admin/management/companies">Company</a></li>
            <li class="breadcrumb-item"><a href="#">Update Company</a></li>
        </ol>

        <div class="mt-4">
            <a href="/admin/management/company/{{ $company->id }}" class="btn btn-primary">
                Go Back
            </a>
        </div>
    </div>

    <div class="container">
        <form method="post" action="/company/update">
            {{ csrf_field() }}

            <input id="company_id" name="company_id" type="hidden" value="{{ $company->id }}">

            <div class="col-sm-12 col-lg-6 mx-auto my-6">

                @include('response_notifiers.response_card')

                <div class="card">
                    <div class="card-header">
                        <h1 class="mb-0">
                            Update Company
                        </h1>
                    </div>

                    <div class="card-body">
                        <h3>Company Details</h3>

                        <div class="d-flex mb-3">
                            <img src="{{ asset($company->image) }}" style="height: 64px; width: 64px;" class="rounded-circle my-auto mr-4"/>
                            <div class="form-group flex-grow-1 mb-0">
                                <label for="image">Image</label>
                                <input type="file" name="image" id="image" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name">Company Name</label>
                            <input id="name" name="name" type="text" class="form-control" maxlength="128"
                                   placeholder="Enter company name" value="{{ $company->name }}" required>
                        </div>

                        <div class="form-group mb-0">
                            <label for="contact">Contact Number</label>
                            <input id="contact" name="contact" type="text" class="form-control"
                                   maxlength="16"
                                   placeholder="Enter contact number (landline/mobile)"
                                   value="{{ $company->contact }}" required>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn bg-orange text-white">
                            Update Company
                        </button>
                    </div>
                </div>
            </div>

        </form>
    </div>
@endsection
