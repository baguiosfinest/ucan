<div class="row">
  <div class="col-lg-4 col-md-4 col-sm-6">
    <div class="card card-stats">
      <div class="card-body ">
        <div class="row">
          <div class="col-5 col-md-4">
            <div class="icon-big text-center icon-warning">
              <i class="nc-icon nc-ambulance text-warning"></i>
            </div>
          </div>
          <div class="col-7 col-md-8">
            <div class="numbers">
              <p class="card-category">Pickup Requests</p>
              <p class="card-title">{{ $users->allpickup_count }}<p>
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer ">
        <hr>
        <div class="stats">
          <a href="{{ route('dashboard.transactions') }}">
            <i class="fa fa-refresh"></i>
            View All
          </a>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-4 col-md-4 col-sm-6">
    <div class="card card-stats">
      <div class="card-body ">
        <div class="row">
          <div class="col-5 col-md-4">
            <div class="icon-big text-center icon-warning">
              <i class="nc-icon nc-money-coins text-success"></i>
            </div>
          </div>
          <div class="col-7 col-md-8">
            <div class="numbers">
                <p class="card-category">Bin Requests</p>
                <p class="card-title">{{ $users->allbin_count }}<p>
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer ">
        <hr>
        <div class="stats">
          <a href="{{ route('dashboard.transactions') }}">
            <i class="fa fa-calendar-o"></i>
            View All
          </a>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-4 col-md-4 col-sm-6">
    <div class="card card-stats">
      <div class="card-body ">
        <div class="row">
          <div class="col-5 col-md-4">
            <div class="icon-big text-center icon-warning">
              <i class="nc-icon nc-single-02 text-danger"></i>
            </div>
          </div>
          <div class="col-7 col-md-8">
            <div class="numbers">
              <p class="card-category">Clients</p>
              <p class="card-title">{{ count($clients) }}<p>
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer ">
        <hr>
        <div class="stats">
          <a href="/dashboard/clients_list">
            <i class="fa fa-user"></i>
            View All
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-6 col-md-6 col-sm-6">
    <div class="card card-stats">
      <div class="card-body ">
        <div class="row">
          <div class="col-5 col-md-4">
            <div class="icon-big text-center icon-success">
              <i class="nc-icon nc-box text-success"></i>
            </div>
          </div>
          <div class="col-7 col-md-8">
            <div class="numbers">
              <p class="card-category">Total Client Bins</p>
              <p class="card-title">{{ $totalbins ?? 0 }}<p>
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer ">
        <hr>
        <div class="stats">
          <a href="{{ route('client-bins') }}">
            <i class="fa fa-refresh"></i>
            View All
          </a>
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-6 col-md-6 col-sm-6">
    <div class="card card-stats">
      <div class="card-body ">
        <div class="row">
          <div class="col-4 col-md-3">
            <div class="icon-big text-center icon-warning">
              <i class="nc-icon nc-map-big text-primary"></i>
            </div>
          </div>
          <div class="col-8 col-md-9">
            <div class="numbers">
              <p class="card-category">Depots</p>
              <p class="card-title">{{ count($depots) }}<p>
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer ">
        <hr>
        <div class="stats">
          <a href="/dashboard/depots">
            <i class="fa fa-map"></i>
            View All
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- <pre>{{ $user }}</pre>
<pre>{{ $depots }}</pre> --}}