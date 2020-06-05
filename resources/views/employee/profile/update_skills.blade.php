@extends('layouts.master')

@section('body')

    <div class="container my-6">
        <div class="row">

            <div class="col-sm-12 col-md-8 col-lg-6 mx-auto">

                <form method="post" action="/profile/skills/update">
                    {{ csrf_field() }}

                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-auto">
                                    <a href="/profile" class="btn btn-secondary icon icon-shape rounded-circle">
                                        <i class="fas fa-arrow-left"></i>
                                    </a>
                                </div>

                                <div class="col-auto my-auto">
                                    <h1 class="mb-0">Update Skills</h1>
                                </div>
                            </div>
                        </div>

                        <div class="card-body pb-0">
                            <label for="skills">Skills</label>
                            <div class="card bg-gray">
                                <div style="margin: 2px;">
                                    <input id="skills" name="skills" type="text" class="form-control"
                                           value="{{ $employee_skills_imploded }}" data-toggle="tags"/>
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
