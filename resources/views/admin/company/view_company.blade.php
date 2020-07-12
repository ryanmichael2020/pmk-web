@extends('layouts.master')

@section('body')
    <div class="p-4 bg-primary-dark">
        <div class="d-flex">
            <h1 class="text-white my-auto">View Company Details</h1>
        </div>

        <ol class="breadcrumb breadcrumb-custom px-0">
            <li class="breadcrumb-item"><a href="/admin/management/companies">Company</a></li>
            <li class="breadcrumb-item"><a href="#">View Company</a></li>
        </ol>

        <div class="mt-4">
            <a href="/admin/management/companies" class="btn btn-primary">
                Go Back
            </a>
        </div>
    </div>

    <div class="container">
        <div class="col-sm-12 col-lg-6 mx-auto my-6">

            @include('response_notifiers.response_card')

            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-auto mr-auto d-flex">
                            @if($company->image !=null)
                                <img src="{{ asset($company->image) }}" class="rounded-circle mr-2"
                                     style="max-height: 92px; max-width: 92px;">

                                <h1 class="mb-0 mx-2 my-auto">
                                    {{ $company->name }}
                                </h1>
                            @else
                                <p class="mb-0">
                                    No company image
                                </p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    {{--                    <div class="form-group">--}}
                    {{--                        <label for="name">Company Name</label>--}}
                    {{--                        <input id="name" name="name" type="text" class="form-control" maxlength="128"--}}
                    {{--                               placeholder="Enter company name" value="{{ $company->name }}" disabled>--}}
                    {{--                    </div>--}}

                    <div class="d-flex">
                        <h3 class="mb-0 mr-4 my-auto">
                            Contact Number
                        </h3>

                        <p class="mb-0 my-auto">
                            {{ $company->contact }}
                        </p>
                    </div>
                </div>

                <div class="card-footer">
                    <a href="/admin/management/company/{{ $company->id }}/update" class="btn bg-orange text-white">
                        Edit
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
