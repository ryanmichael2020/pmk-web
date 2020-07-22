<div class="col-12 col-md-8 col-lg-6 col-xl-4">

    <div class="card my-2">
        <div class="card-header">
            <h2 class="mb-0">
                Daily Logins
            </h2>
        </div>

        <div class="card-body">
            <div class="row">

                <div class="col-12 text-center">
                    <div class="card my-2">
                        <div class="card-header bg-gradient-default text-white">
                            <i class="fas fa-sign-in-alt fa-2x"></i>
                            <p class="mb-0">
                                Total
                            </p>
                        </div>

                        <div class="card-body">
                            <h2 class="mb-0">
                                {{ $daily_login_total }}
                            </h2>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 pr-md-1 text-center">

                    <div class="card my-2">
                        <div class="card-header bg-green text-white">
                            <i class="fas fa-user-tie fa-2x"></i>
                            <p class="mb-0">
                                Employers
                            </p>
                        </div>

                        <div class="card-body">
                            <h1 class="mb-0">
                                {{ $daily_login_employer }}
                            </h1>
                        </div>
                    </div>

                </div>

                <div class="col-12 col-md-6 pl-md-1 text-center">

                    <div class="card my-2">
                        <div class="card-header bg-primary text-white">
                            <i class="fas fa-users fa-2x"></i>
                            <p class="mb-0">
                                Employees
                            </p>
                        </div>

                        <div class="card-body">
                            <h1 class="mb-0">
                                {{ $daily_login_employer }}
                            </h1>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

</div>
