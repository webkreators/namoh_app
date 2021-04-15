@if (\Route::is('login') || \Route::is('forgot.password'))
<div class="navbar navbar-expand-md navbar-dark" style="background: #f7f8fb;">
    <div class="navbar-brand wmin-0 mr-5">
        <a href="#" class="d-inline-block">
        </a>
    </div>
</div>
@else
<div class="navbar navbar-expand-md navbar-dark common-navbar-dark-color-code">
    <div class="navbar-brand wmin-0 mr-5 custom-navbar-brnd">
        <a href="{{ route('dashboard') }}" class="d-inline-block">
            <h5 class="pay-service-logo">{{ env('APP_NAME') }}</h5>
        </a>
    </div>
    <div class="d-md-none custom-right-bar">
        <button class="navbar-toggler dropdown-toggle" type="button" data-toggle="collapse" data-target="#navbar-mobile">
            <span>{{ Auth::user()->company_name }}</span>
        </button>
        <div class="dropdown-menu dropdown-menu-right" id="navbar-mobile">
            <a href="{{ route('logout') }}" class="dropdown-item"><i class="icon-switch2"></i> Logout</a>
            <a href="#" class="dropdown-item dropdown-toggle" data-toggle="dropdown">
                <span><i class="icon-earth"></i></span>
            </a>
        </div>
    </div>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a href="#" class="navbar-nav-link dropdown-toggle caret-0" data-toggle="dropdown" aria-expanded="false">
                    <i class="icon-bubble-notification"></i>
                    <span class="d-md-none ml-2">Activity</span>
                    <span class="badge badge-mark border-orange-400 ml-auto ml-md-0"></span>
                </a>
                <div class="dropdown-menu dropdown-content wmin-md-350">
                    <div class="dropdown-content-header">
                        <span class="font-weight-semibold">Notifications</span>
                    </div>
                    <div class="dropdown-content-body dropdown-scrollable">
                        <ul class="media-list">
                            @foreach (\App\Models\Customer::checkNotifications() as $notification)
                            <li class="media">
                                <div class="mr-3">
                                    <a href="#" class="btn bg-success-400 rounded-round btn-icon"><i class="{{ $notification['icon'] }}"></i></a>
                                </div>
                                <div class="media-body">
                                    {{ $notification['message'] }}
                                    <div class="font-size-sm text-muted mt-1">{{ $notification['when'] }}</div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown dropdown-user">
                <a href="#" class="navbar-nav-link d-flex align-items-center dropdown-toggle" data-toggle="dropdown">
                    <span>{{ Auth::user()->company_name }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a href="{{ route('logout') }}" class="dropdown-item"><i class="icon-switch2"></i> Logout</a>
                </div>
            </li>
        </ul>
    </div>
</div>
<div class="navbar navbar-expand-md navbar-light navbar-sticky common-navbar-sticky-color-code">
    <div class="container">
        <div class="text-center d-md-none w-100">
            <button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-navigation">
                <i class="icon-unfold mr-2"></i>
                Navigation
            </button>
        </div>
        <div class="navbar-collapse collapse" id="navbar-navigation">
            <ul class="navbar-nav nav-links">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="navbar-nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                        <i class="icon-grid mr-2"></i>
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('users') }}" class="navbar-nav-link {{ Request::is('admin/users') ? 'active' : '' }}">
                        <i class="icon-users mr-2"></i>
                        Users
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a href="{{ route('customers') }}" class="navbar-nav-link {{ Request::is('admin/customers') ? 'active' : '' }}">
                        <i class="icon-users2 mr-2"></i>
                        Customers
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a href="{{ route('services') }}" class="navbar-nav-link {{ Request::is('admin/services') ? 'active' : '' }}">
                        <i class="icon-cart mr-2"></i>
                        Services
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a href="{{ route('invoices') }}" class="navbar-nav-link {{ Request::is('admin/invoices') || Request::is('admin/invoices/add') ? 'active' : '' }}">
                        <i class="icon-list2 mr-2"></i>
                        Invoices
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('settings') }}" class="navbar-nav-link {{ Request::is('admin/accounts') ? 'active' : '' }}">
                        <i class="icon-calculator3 mr-2"></i>
                        Settings
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
@endif