@if (\Route::is('login') || \Route::is('forgot.password'))
  <div class="navbar navbar-expand-md navbar-dark" style="background: #f7f8fb;">
    <div class="navbar-brand wmin-0 mr-5">
      <a href="#" class="d-inline-block">
      </a>
    </div>
  </div>
@else
  <div class="navbar navbar-expand-md navbar-dark">
  <div class="navbar-brand wmin-0 mr-5">
    <a href="{{ route('dashboard') }}" class="d-inline-block">
      <h5 class="pay-service-logo">Namoh Network</h5>
    </a>
  </div>
  <div class="d-md-none">
    <button class="navbar-toggler dropdown-toggle" type="button" data-toggle="collapse" data-target="#navbar-mobile">
      <span>{{ Auth::user()->name }}</span>
    </button>
    <div class="dropdown-menu dropdown-menu-right" id="navbar-mobile">
      <a href="{{ route('logout') }}" class="dropdown-item"><i class="icon-switch2"></i> Logout</a>
      <a href="#" class="dropdown-item dropdown-toggle" data-toggle="dropdown">
        <span><i class="icon-earth"></i></span>
      </a>
    </div>
  </div>
  <div class="collapse navbar-collapse">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown dropdown-user">
        <a href="#" class="navbar-nav-link d-flex align-items-center dropdown-toggle" data-toggle="dropdown">
          <span>{{ Auth::user()->name }}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
          <a href="{{ route('logout') }}" class="dropdown-item"><i class="icon-switch2"></i> Logout</a>
        </div>
      </li>
    </ul>
  </div>
</div>
<div class="navbar navbar-expand-md navbar-light navbar-sticky">
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
            <i class="icon-toggle mr-2"></i>
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
          <a href="javascript:void(0)" class="navbar-nav-link dropdown-toggle {{ Request::is('admin/services') ? 'active' : '' }}" data-toggle="dropdown">
            <i class="icon-users2 mr-2"></i>
            Services
          </a>
          <div class="dropdown-menu">
            <a href="{{ route('users') }}" class="dropdown-item"> <i class="icon-users4 mr-2"></i> All Users</a>
            <a href="{{ route('users') }}?type=vendor" class="dropdown-item"> <i class="icon-user-tie mr-2"></i> Vendors</a>
            <a href="{{ route('users') }}?type=customer" class="dropdown-item"> <i class="icon-user mr-2"></i> Customers</a> 
            <a href="{{ route('users') }}?type=manager" class="dropdown-item"> <i class="icon-user mr-2"></i> Managers</a> 
          </div>
        </li>
        <li class="nav-item">
          <a href="{{ route('orders.list') }}" class="navbar-nav-link {{ Request::is('admin/orders') ? 'active' : '' }}">
            <i class="icon-basket mr-2"></i>
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