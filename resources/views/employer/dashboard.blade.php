@extends('layouts.master')

@section('body')
    @include('nav.employer.nav')

    <div class="container my-4">
        <div class="row">
            <div class="col-sm-12 col-md-8 mx-auto">
                <input type="text" class="form-control" placeholder="Search job post.."/>
            </div>

            <div class="col-sm-12">
                @include('component.job_posts')
            </div>
        </div>
    </div>
@endsection
