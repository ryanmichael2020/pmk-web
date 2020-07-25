<?php
$nav_notifications = \App\Models\Notification\Notification::where('recipient_id', auth()->user()->id)
    ->orderBy('created_at', 'desc')
    ->get();
?>

<nav class="navbar navbar-horizontal navbar-expand-lg navbar-dark bg-default">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">P.E.S.O Makati</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-default"
                aria-controls="navbar-default" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbar-default">
            <div class="navbar-collapse-header">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="/">
                            LOGO
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse"
                                data-target="#navbar-default" aria-controls="navbar-default" aria-expanded="false"
                                aria-label="Toggle navigation">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>

            <ul class="navbar-nav ml-lg-auto">
                <li class="nav-item dropdown text-white">
                    <a href="/job_posts" class="nav-link nav-link-icon">
                        Job Posts
                    </a>
                </li>

                <li class="nav-item text-white">
                    <a href="/job_applications" class="nav-link nav-link-icon">
                        Job Applications
                    </a>
                </li>

                <li class="nav-item text-white">
                    <a href="/job_offers" class="nav-link nav-link-icon">
                        Job Offers
                    </a>
                </li>

                <li class="nav-item dropdown text-white">
                    <a href="#" class="nav-link nav-link-icon" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Notifications
                    </a>

                    <div class="dropdown-menu dropdown-menu-right dropdown-notifications">
                        @if(count($nav_notifications) > 0)
                            @foreach($nav_notifications as $notification)
                                <div class="card mx-3 my-2 bg-transluscent-dark">
                                    <div class="card-body py-2 px-3">
                                        <h1 class="mb-0" style="font-size: 16px;">
                                            {{ $notification->title }}
                                        </h1>

                                        <p class="mb-0 text-small">
                                            {{ $notification->message }}
                                        </p>

                                        <hr class="bg-white my-2"/>

                                        <span class="mb-0 pr-2 my-auto text-smaller" data-toggle="tooltip"
                                              data-placement="right" title="{{ $notification->created_at }}">
                                            {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $notification->created_at)->diffForHumans() }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="card mx-3 my-2 bg-transluscent-dark">
                                <div class="card-body py-2 px-3">
                                    <p class="mb-0">No recent notifications</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </li>

                <li class="nav-item dropdown text-white">
                    <a class="nav-link nav-link-icon py-0" href="#" id="navbar-user-icon-dropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                        <div class="dropdown-divider mb-3 d-md-none"></div>

                        <div class="d-flex">
                            <img class="avatar rounded-circle py-0"
                                 src="{{ asset(auth()->user()->userDetail->image) }}"
                                 style="height: 48px; width: 48px;">

                            <div class="my-auto ml-2 d-block d-md-none">
                                <strong class="mb-0 text-small">
                                    {{ strtoupper(auth()->user()->userDetail->name()) }}
                                </strong>
                                <p class="mb-0 text-smaller">
                                    {{ auth()->user()->email }}
                                </p>
                            </div>
                        </div>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbar-user-icon-dropdown">
                        <a href="#" class="dropdown-item d-none d-md-block">
                            <strong>
                                {{ strtoupper(auth()->user()->userDetail->name()) }}
                            </strong>

                            <p class="mb-0" style="font-size: 12px;">
                                {{ strtolower(auth()->user()->email) }}
                            </p>
                        </a>

                        @if(auth()->user()->employee->company_id != null)
                            <div class="dropdown-divider"></div>

                            <a href="/company/{{ auth()->user()->employee->company_id }}" class="dropdown-item">
                                <img src="{{ asset(auth()->user()->employee->company->image) }}"
                                     style="height: 32px; width: 32px;">
                                {{ auth()->user()->employee->company->name }}
                            </a>
                        @endif

                        <div class="dropdown-divider"></div>

                        <a class="dropdown-item" href="/profile">
                            <i class="fas fa-user"></i>
                            Profile
                        </a>

                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item" data-toggle="modal" data-target="#modal_logout">
                            <i class="fas fa-sign-out-alt"></i>
                            Logout
                        </a>
                    </div>
                </li>
            </ul>

        </div>
    </div>
</nav>
