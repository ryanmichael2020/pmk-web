@extends('layouts.master')

@section('body')
    @include('nav.nav')

    <div class="container">
        <form method="post" action="/company/update">
            {{ csrf_field() }}

            <input id="company_id" name="company_id" type="hidden" value="{{ $company->id }}">

            <div class="col-sm-12 col-lg-6 mx-auto my-6">

                @include('response_notifiers.response_card')

                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-auto">
                                <a href="/admin/management/companies"
                                   class="btn btn-secondary icon icon-shape rounded-circle">
                                    <i class="fas fa-arrow-left"></i>
                                </a>
                            </div>

                            <div class="col-auto my-auto">
                                <h1 class="mb-0">
                                    <i class="fas fa-building" style="margin-right: 8px;"></i>
                                    Update Company
                                </h1>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <h3>Company Details</h3>
                        <div class="form-group">
                            <label for="name">Company Name</label>
                            <input id="name" name="name" type="text" class="form-control" maxlength="128"
                                   placeholder="Enter company name" value="{{ $company->name }}" required>
                        </div>

                        <div class="form-group">
                            <label for="contact">Contact Number</label>
                            <input id="contact" name="contact" type="text" class="form-control"
                                   maxlength="16"
                                   placeholder="Enter contact number (landline/mobile)"
                                   value="{{ $company->contact }}" required>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn bg-orange text-white form-control">
                            Update Company
                        </button>
                    </div>
                </div>
            </div>

        </form>
    </div>
@endsection
