<div class="row">
  <div class="col-lg-3 col-md-3 col-sm-6">
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
              <p class="card-category">My Pickup Requests</p>
              <p class="card-title">{{ auth()->user()->pickupcount }}<p>
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer ">
        <hr>
        <div class="stats">
          <a href="{{ route('request-a-pickup') }}">
            <i class="fa fa-refresh"></i>
            View All
          </a>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-3 col-sm-6">
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
              <p class="card-category">My Bin Requests</p>
              <p class="card-title">{{ auth()->user()->bincount }}<p>
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer ">
        <hr>
        <div class="stats">
          <a  href="{{ route('request-a-bin') }}">
            <i class="fa fa-calendar-o"></i>
            View All
          </a>
        </div>
      </div>
    </div>
  </div>
  
  <div class="col-lg-3 col-md-3 col-sm-6">
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
  <div class="col-lg-3 col-md-3 col-sm-6">
    <div class="card bg-success card-stats text-white">
      <div class="card-body">
        <div class="row">
          <div class="col-5 col-md-4">
            <div class="icon-big text-center icon-success">
              <i class="nc-icon nc-box text-white"></i>
            </div>
          </div>
          <div class="col-7 col-md-8">
            <div class="numbers">
              <p class="card-category text-white">My Current Bin</p>
              <p class="card-title">0<p>
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer ">
        <hr>
        <div class="stats">
          <a href="{{ route('request-a-bin') }}" class="text-white">
            <i class="fa fa-refresh text-white"></i>
            Request a Bin
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- <pre>{{ $user }}</pre>
<pre>{{ $depots }}</pre> --}}