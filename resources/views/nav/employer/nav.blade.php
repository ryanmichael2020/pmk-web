<nav class="navbar navbar-horizontal navbar-expand-lg navbar-dark bg-default ">
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
                <li class="nav-item dropdown text-white my-auto">
                    <a class="nav-link nav-link-icon" href="#" id="navbar-job-posts-dropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Job Posts
                    </a>

                    <div class="dropdown-menu" aria-labelledby="navbar-job-posts-dropdown">
                        <a class="dropdown-item" href="/employer/job_post/create">
                            Create Job Post
                        </a>

                        <div class="dropdown-divider"></div>

                        <a class="dropdown-item" href="/employer/job_posts">
                            View Created Job Posts
                        </a>
                    </div>
                </li>

                <li class="nav-item text-white my-auto">
                    <a href="/employer/job_offers" class="nav-link nav-link-icon">
                        Job Offers
                    </a>
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
                            {{-- <img class="avatar rounded-circle" src="{{ auth()->user()->userDetail->image }}" style="height: 32px; width: 32px;"> --}}
                            <strong>
                                {{ strtoupper(auth()->user()->userDetail->name()) }}
                            </strong>

                            <p class="mb-0" style="font-size: 12px;">
                                {{ strtolower(auth()->user()->email) }}
                            </p>
                        </a>

                        <div class="dropdown-divider"></div>

                        <a href="/company/{{ auth()->user()->employer->company_id }}" class="dropdown-item">
                            <img src="{{ asset(auth()->user()->employer->company->image) }}"
                                 style="height: 32px; width: 32px;">
                            {{ auth()->user()->employer->company->name }}
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

