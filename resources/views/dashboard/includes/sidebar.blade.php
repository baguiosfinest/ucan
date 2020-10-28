<div class="sidebar" data-color="white" data-active-color="danger">
  <div class="logo">
    <a href="https://www.creative-tim.com" class="simple-text logo-mini">
      <div class="logo-image-small">
        <img src="{{ asset('img/recycle.png')}}">
      </div>
      <!-- <p>CT</p> -->
    </a>
    <a href="/dashboard" class="simple-text logo-normal">
      U Can Recycle WA
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="{{ (request()->routeIs('dashboard.index')) ? 'active' : '' }}">
        <a href="/dashboard/index">
          <i class="nc-icon nc-bank"></i>
          <p>Dashboard</p>
        </a>
      </li>
      {{-- <li>
        <a href="./icons.html">
          <i class="nc-icon nc-diamond"></i>
          <p>Icons</p>
        </a>
      </li> --}}
      <li class="{{ ((request()->path()) == 'dashboard/depots') ? 'active' : '' }}">
        <a href="/dashboard/depots">
          <i class="nc-icon nc-pin-3"></i>
          <p>Depots</p>
        </a>
      </li>

      @if (auth()->user()->is_admin == 1)

        <li class="{{ (((request()->path()) == 'dashboard/users_list')) ? 'active' : '' }}">
          <a href="/dashboard/users_list">
            <i class="nc-icon nc-single-02"></i>
            <p>Users</p>
          </a>
        </li>

        <li class="{{ (request()->is('dashboard/clients_list/*') || request()->is('dashboard/clients_list')) ? 'active' : '' }}">
          <a href="/dashboard/clients_list">
            <i class="nc-icon nc-tile-56"></i>
            <p>Clients</p>
          </a>
        </li>

        <li class="{{ (request()->routeIs('dashboard.transactions') || request()->routeIs('transactions.create')) ? 'active' : '' }}">
          <a href="/dashboard/transactions">
            <i class="nc-icon nc-bell-55"></i>
            <p>Transactions</p>
          </a>
        </li>

        <li class="{{ (request()->is('dashboard/employees/*') || request()->is('dashboard/employees')) ? 'active' : '' }}">
          <a href="/dashboard/employees">
            <i class="nc-icon nc-circle-10"></i>
            <p>Employees</p>
          </a>
        </li>

      @else

        <li class="{{ (request()->routeIs('request-a-bin')) ? 'active' : '' }}">
          <a href="/dashboard/request-a-bin">
            <i class="nc-icon nc-box"></i>
            <p>Request a Bin</p>
          </a>
        </li>

        <li class="{{ (request()->routeIs('request-a-pickup')) ? 'active' : '' }}">
          <a href="/dashboard/request-a-pickup">
            <i class="nc-icon nc-delivery-fast"></i>
            <p>Request a PickUp</p>
          </a>
        </li>

      @endif

      <li class="{{ (request()->routeIs('dashboard.profile')) ? 'active' : '' }}">
        <a href="/dashboard/profile">
          <i class="nc-icon nc-satisfied"></i>
          <p>My Profile</p>
        </a>
      </li>
      <li class="active-pro">
        <a href="http://www.ucanrecyclewa.com.au">
          <i class="nc-icon nc-spaceship"></i>
          <p>Visit Our Website</p>
        </a>
      </li>
    </ul>
  </div>
</div>