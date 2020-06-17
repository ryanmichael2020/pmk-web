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
    <link rel="stylesheet" href="{{ asset('vendor/nucleo/css/nucleo.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('vendor/@fortawesome/fontawesome-free/css/all.min.css') }}" type="text/css">

    <!-- Argon CSS -->
    <link rel="stylesheet" href="{{ asset('css/argon.css') }}" type="text/css">

    @yield('header')
</head>

<body class="g-sidenav-pinned">
@guest
    <div id="app">
        @yield('body')
    </div>
@else
    @if(auth()->user() != null)
        @if(auth()->user()->user_type_id == \App\Models\User\UserType::$ADMIN)
            @include('nav.side_nav')
        @endif
    @endif

    <div class="main-content" id="app">
        @yield('body')

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
                    <div class="modal-body py-0">
                        <p class="mb-0">
                            Are you sure you want to logout?
                        </p>
                    </div>
                    <div class="modal-footer">
                        <form method="post" action="/logout">
                            {{ csrf_field() }}

                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endguest

<!-- Core -->
<script src="{{ asset('vendor/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/js-cookie/js.cookie.js') }}"></script>
<script src="{{ asset('vendor/jquery.scrollbar/jquery.scrollbar.min.js') }}"></script>

@yield('script')

<!-- Argon JS -->
<script src="{{ asset('js/argon.js') }}"></script>

</body>

</html>

