@if(auth()->user() != null)
    <nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-gradient-white"
         id="sidenav-main">

        <div class="scrollbar-inner">
            <div class="sidenav-header d-flex align-items-center">
                <a class="navbar-brand" href="/management/products/stocks">
                <span class="navbar-brand-img">
                    MNLC
                </span>
                </a>
                <div class="ml-auto">
                    <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin"
                         data-target="#sidenav-main">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="navbar-inner">
                <div class="col">
                    <div class="row">
                        <div class="my-auto" style="">
                            <i class="fas fa-user" style="width: 24px; font-size: 24px;"></i>
                        </div>
                        <div style="width: 16px;"></div>
                        <div>
                            <p style="margin-bottom: 0px;">
                                {{ auth()->user()->userDetail->first_name }} {{ auth()->user()->userDetail->last_name }}
                            </p>
                            <p style="margin-bottom: 0px; font-size: 12px;">
                                {{ auth()->user()->email }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="collapse navbar-collapse" id="sidenav-collapse-main">

                    <ul class="navbar-nav">

                        @if(auth()->user()->user_type_id == \App\UserType::$ADMIN || auth()->user()->user_type_id == \App\UserType::$STAFF)
                            {{-- Manage Inventory --}}
                            <li class="nav-item">
                                <a class="nav-link" href="/management/products/stocks" role="button"
                                   aria-expanded="false" aria-controls="navbar-tables">
                                    <i class="fas fa-warehouse"></i>
                                    <span class="nav-link-text">
                                Manage Inventory
                            </span>
                                </a>
                            </li>
                        @endif

                        @if(auth()->user()->user_type_id == \App\UserType::$ADMIN || auth()->user()->user_type_id == \App\UserType::$STAFF)
                            {{-- Manage Orders --}}
                            <li class="nav-item">
                                <a class="nav-link" href="/management/products/orders" role="button"
                                   aria-expanded="false" aria-controls="navbar-tables">
                                    <i class="fas fa-box"></i>
                                    <span class="nav-link-text">
                                Manage Orders
                            </span>
                                </a>
                            </li>
                        @endif

                        @if(auth()->user()->user_type_id == \App\UserType::$ADMIN || auth()->user()->user_type_id == \App\UserType::$STAFF)
                            {{-- Manage Sales --}}
                            <li class="nav-item">
                                <a class="nav-link" href="/management/products/transactions" role="button"
                                   aria-expanded="false" aria-controls="navbar-tables">
                                    <i class="fas fa-money-bill-wave"></i>
                                    <span class="nav-link-text">
                                Manage Sales
                            </span>
                                </a>
                            </li>
                        @endif

                        @if(auth()->user()->user_type_id == \App\UserType::$ADMIN || auth()->user()->user_type_id == \App\UserType::$STAFF)
                            {{-- Manage Products --}}
                            <li class="nav-item">
                                <a class="nav-link" href="#parent_product_management" data-toggle="collapse"
                                   role="button"
                                   aria-expanded="false" aria-controls="navbar-tables" id="nav_product_management">
                                    <i class="fas fa-box-open"></i>
                                    <span class="nav-link-text">
                                    Manage Products
                                </span>
                                </a>
                                <div class="collapse" id="parent_product_management">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="/management/products/create" class="nav-link" id="product_list">
                                                Add Product
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="/management/products" class="nav-link"
                                               id="product_type_list">
                                                View Products
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        @endif

                        @if(auth()->user()->user_type_id == \App\UserType::$ADMIN || auth()->user()->user_type_id == \App\UserType::$STAFF)
                            {{-- Manage Product Types--}}
                            <li class="nav-item">
                                <a class="nav-link" href="#parent_product_type_management" data-toggle="collapse"
                                   role="button"
                                   aria-expanded="false" aria-controls="navbar-tables" id="nav_product_management">
                                    <i class="fas fa-filter"></i>
                                    <span class="nav-link-text">
                                    Manage Product Types
                                </span>
                                </a>
                                <div class="collapse" id="parent_product_type_management">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="/management/product_types/create" class="nav-link"
                                               id="product_list">
                                                Add Product Type
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="/management/product_types" class="nav-link"
                                               id="product_type_list">
                                                View Product Types
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        @endif

                        @if(auth()->user()->user_type_id == \App\UserType::$ADMIN || auth()->user()->user_type_id == \App\UserType::$STAFF)
                            {{-- Manage Reports --}}
                            <li class="nav-item">
                                <a class="nav-link" href="#parent_reports_management" data-toggle="collapse"
                                   role="button"
                                   aria-expanded="false" aria-controls="navbar-tables" id="nav_reports_management">
                                    <i class="fas fa-folder-open"></i>
                                    <span class="nav-link-text">
                                Manage Reports
                            </span>
                                </a>
                                <div class="collapse" id="parent_reports_management">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="/management/reports/sales_report" class="nav-link">
                                                Sales Report
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        @endif

                        {{-- Manage Accounts--}}
                        @if(auth()->user()->hasAccountManagementAccess())
                            {{-- Manage Users --}}
                            <li class="nav-item">
                                <a class="nav-link" href="#parent_user_management" data-toggle="collapse" role="button"
                                   aria-expanded="false" aria-controls="navbar-tables" id="nav_product_management">
                                    <i class="fas fa-users-cog"></i>
                                    <span class="nav-link-text">
                                Manage Users
                            </span>
                                </a>
                                <div class="collapse" id="parent_user_management">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="/management/users/create" class="nav-link">
                                                Create Account
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="/management/users" class="nav-link"
                                               id="product_type_list">
                                                View Users
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            {{-- Manage Customers --}}
                            <li class="nav-item">
                                <a class="nav-link" href="#parent_customer_management" data-toggle="collapse"
                                   role="button"
                                   aria-expanded="false" aria-controls="navbar-tables" id="nav_product_management">
                                    <i class="fas fa-address-card"></i>
                                    <span class="nav-link-text">
                                Manage Customers
                            </span>
                                </a>
                                <div class="collapse" id="parent_customer_management">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="/management/customers/create" class="nav-link">
                                                Create Customer
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="/management/customers" class="nav-link"
                                               id="product_type_list">
                                                View Customers
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            {{-- Manage Suppliers --}}
                            <li class="nav-item">
                                <a class="nav-link" href="#parent_supplier_management" data-toggle="collapse"
                                   role="button"
                                   aria-expanded="false" aria-controls="navbar-tables" id="nav_product_management">
                                    <i class="fas fa-parachute-box"></i>
                                    <span class="nav-link-text">
                                Manage Suppliers
                            </span>
                                </a>
                                <div class="collapse" id="parent_supplier_management">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="/management/suppliers/create" class="nav-link">
                                                Create Supplier
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="/management/suppliers" class="nav-link"
                                               id="product_type_list">
                                                View Suppliers
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        @endif

                        @if(auth()->user()->user_type_id == \App\UserType::$ADMIN || auth()->user()->user_type_id == \App\UserType::$STAFF)
                            {{-- Action Logs --}}
                            <li class="nav-item">
                                <a class="nav-link" href="/management/logs/actions" role="button"
                                   aria-expanded="false" aria-controls="navbar-tables">
                                    <i class="fas fa-sticky-note"></i>
                                    <span class="nav-link-text">
                                Action Logs
                            </span>
                                </a>
                            </li>
                        @endif

                        @if(auth()->user()->user_type_id == \App\UserType::$ADMIN || auth()->user()->user_type_id == \App\UserType::$STAFF)
                            {{-- Action Logs --}}
                            <li class="nav-item">
                                <a class="nav-link" href="/management/alerts" role="button"
                                   aria-expanded="false" aria-controls="navbar-tables">
                                    <i class="fas fa-exclamation-circle"></i>
                                    <span class="nav-link-text">
                                Alerts
                            </span>
                                </a>
                            </li>
                        @endif

                        @if(auth()->user()->user_type_id == \App\UserType::$COURIER)
                            <li class="nav-item">
                                <a class="nav-link" href="/management/courier/deliveries" role="button"
                                   aria-expanded="false" aria-controls="navbar-tables">
                                    <i class="fas fa-truck-moving"></i>
                                    <span class="nav-link-text">
                            Deliveries
                        </span>
                                </a>
                            </li>
                        @endif

                        {{-- Logout --}}
                        <li class="nav-item">
                            <a href="#" class="nav-link" data-toggle="modal" data-target="#modal_logout">
                                <i class="fas fa-sign-out-alt"></i>
                                <span class="nav-link-text">Logout</span>
                                <form id="logout-form" action="" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
@endif
