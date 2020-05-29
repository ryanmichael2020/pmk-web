<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Argon Dashboard PRO</title>

    <!-- Favicon -->
    <link href="{{ asset('img/brand/favicon.png') }}" rel="icon" type="image/png">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

    <!-- Icons -->
    <link href="{{ asset('vendor/nucleo/css/nucleo.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet">

    <!-- Argon CSS -->
    <link type="text/css" href="{{ asset('css/argon.min.css') }}" rel="stylesheet">

    @yield('header')
</head>

<body>

@guest
    <div id="app">
        @yield('body')
    </div>
@else
    @include('nav.side_nav')

    <div class="main-content" id="app">
        <div class="container-fluid mt--6">
            <div class="row">
                <div class="col">
                    @yield('body')
                </div>
            </div>
        </div>

        {{-- Logout Modal --}}
        <div class="modal fade" id="modal_logout" tabindex="-1" role="dialog" aria-labelledby="modal_lbl_logout"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 id="modal_lbl_logout">Logout</h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to logout?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <a href="/logout">
                            <button type="button" class="btn btn-danger">Logout</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endguest

<!-- Core -->
<script src="{{ asset('vendor/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>

<!-- Argon JS -->
<script src="{{ asset('js/argon.min.js') }}"></script>
</body>

</html>

