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

                <li class="nav-item dropdown text-white">
                    <a class="nav-link nav-link-icon py-0" href="#" id="navbar-user-icon-dropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="avatar rounded-circle py-0" src="{{ auth()->user()->userDetail->image }}"
                             style="height: 48px; width: 48px;">
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbar-user-icon-dropdown">
                        <a href="#" class="dropdown-item">
                            <strong>
                                {{ strtoupper(auth()->user()->userDetail->name()) }}
                            </strong>

                            <p class="mb-0" style="font-size: 12px;">
                                {{ strtolower(auth()->user()->email) }}
                            </p>
                        </a>

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

