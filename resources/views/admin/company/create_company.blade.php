@extends('layouts.master')

@section('body')
    <div class="p-4 bg-primary-dark">
        <div class="d-flex">
            <h1 class="text-white my-auto">Create Company</h1>
        </div>

        <ol class="breadcrumb breadcrumb-custom px-0">
            <li class="breadcrumb-item"><a href="/admin/management/companies">Company</a></li>
            <li class="breadcrumb-item"><a href="#">Create Company</a></li>
        </ol>

        <div class="mt-4">
            <a href="/admin/management/companies" class="btn btn-primary">
                Go Back
            </a>
        </div>
    </div>

    <div class="container">
        <form method="post" action="/companies/create" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="col-sm-12 col-lg-6 mx-auto my-6">

                @include('response_notifiers.response_card')

                <div class="card">
                    <div class="card-header">
                        <h1 class="mb-0">Create Company</h1>
                    </div>

                    <div class="card-body">
                        <h3>Company Details</h3>

                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" name="image" id="image" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="name">Company Name</label>
                            <input id="name" name="name" type="text" class="form-control" maxlength="128"
                                   placeholder="Enter company name" required>
                        </div>

                        <div class="form-group mb-0">
                            <label for="contact">Contact Number</label>
                            <input id="contact" name="contact" type="text" class="form-control"
                                   maxlength="16"
                                   placeholder="Enter contact number (landline/mobile)" required>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary form-control">
                            Create Company
                        </button>
                    </div>
                </div>
            </div>

        </form>
    </div>
@endsection
