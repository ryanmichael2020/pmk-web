@extends('layouts.master')

@section('header')
    <style type="text/css">
        .bootstrap-tagsinput {
            width: 100% !important;
        }
    </style>
@endsection

@section('body')
    @include('nav.employee.nav')

    <hr class="my-0 bg-default">
    <div class="bg-primary-dark">
        <div class="container">
            <div class="row pt-3 pb-4 mb-0">
                <div class="col-sm-12 px-0">
                    <h1 class="mb-0 text-white">Employee Skills</h1>

                    <ol class="breadcrumb breadcrumb-custom px-0">
                        <li class="breadcrumb-item"><a href="/profile">Employee Profile</a></li>
                        <li class="breadcrumb-item"><a href="#">Employee Skills</a></li>
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

                <form method="post" action="/profile/skills/update">
                    {{ csrf_field() }}

                    @include('response_notifiers.response_card')

                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-auto">
                                    <h1 class="mb-0">Employee Skills</h1>
                                </div>
                            </div>
                        </div>

                        <div class="card-body pb-0">
                            <label for="skills">Skills</label>
                            <div class="card bg-gray">
                                <div style="margin: 4px;">
                                    <input id="skills" name="skills" type="text" class="form-control"
                                           value="{{ $employee_skills_imploded }}" placeholder="Add a skill" data-toggle="tags"/>
                                </div>
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

@section('script')
    <script src="{{ asset('/vendor/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
@endsection
