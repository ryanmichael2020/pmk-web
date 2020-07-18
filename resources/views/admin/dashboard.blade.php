@extends('layouts.master')

@section('header')
    <style type="text/css">
        .break {
            flex-basis: 100%;
            height: 0;
        }
    </style>
@endsection

@section('body')
    @include('nav.nav')

    <div class="container-fluid">
        <div class="row my-4">

            @include('admin._dashboard_daily_logins')
            @include('admin._dashboard_registered_users')
            @include('admin._dashboard_job_applications')

        </div>
    </div>
@endsection
