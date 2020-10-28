@extends('layouts.dashboard')
@section('title','UCANRECYCLE WA Depots')
@section('maintitle','Add Location')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header ">
         Add a depot location to be visible on the map.
        </div>
        <div class="card-body">
        
          <form method="POST" action="{{ action('DepotController@store') }}">             
              @csrf
              <div class="row">
                <div class="col-md-6 pr-1">
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Name" value="">
                  </div>
                </div>
                <div class="col-md-6 pl-1">
                  <div class="form-group">
                    <label for="phonenumber">Phone</label>
                    <input type="number" name="phonenumber" class="form-control" placeholder="Phone" value="">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Address</label>
                    <input type="text" name="address" class="form-control" placeholder="Business Address" value="">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 pr-1">
                  <div class="form-group">
                    <label>Suburb</label>
                    <input type="suburb" name="suburb" class="form-control" placeholder="Suburb" value="">
                  </div>
                </div>
                <div class="col-md-6 pl-1">
                  <div class="form-group">
                    <label>State</label>
                    <input type="text" name="state" class="form-control" placeholder="State" value="">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 pr-1">
                  <div class="form-group">
                    <label>Postcode</label>
                    <input type="number" name="postcode" class="form-control" placeholder="Postcode" value="">
                  </div>
                </div>
                <div class="col-md-6 pl-1">
                  <div class="form-group">
                    <label>Country</label>
                    <input type="text" name="country" class="form-control" placeholder="Country" value="">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 pr-1">
                  <div class="form-group">
                    <label>Latitude</label>
                    <input type="suburb" name="latitude" class="form-control" placeholder="Latitude" value="">
                  </div>
                </div>
                <div class="col-md-6 pl-1">
                  <div class="form-group">
                    <label>Longtitude</label>
                    <input type="text" name="longtitude" class="form-control" placeholder="Longtitude" value="">
                  </div>
                </div>
              </div>
              
              <div class="row">
                <div class="update ml-auto mr-auto">
                  <button type="submit" class="btn btn-success btn-round">Add Location</button>
                  <a href="/dashboard/depots" class="btn btn-info btn-round">Cancel</a>
                </div>
              </div>
            </form>

        </div>
      </div>
    </div>
  </div>
@endsection

