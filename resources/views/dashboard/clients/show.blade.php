@extends('layouts.dashboard')
@section('title','View Client Information')
@section('maintitle', 'View Client Information')

@section('script-top')
  <script src='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.js'></script>
  <link href='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.css' rel='stylesheet' />
  <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')

  <div class="card">
      <div class="card-header clearfix">
        <h4 class="pull-left card-title">Client Information</h4>
        <a class="pull-right btn btn-danger btn-round" href="{{ route('client.index') }}">Back</a>
        <button class="pull-right btn btn-success btn-round mr-1" data-toggle="modal" data-id="{{ $client->id }}" data-target="#addbin">Add Bin</button>
       
      </div>
      <div class="card-body">
        <form method="POST" action="{{ route('client.update') }}">
              {{ csrf_field() }}
              @method('PUT')
              <input type="hidden" name="client_id" value="{{ $client->id }}" />
              <div class="row">
                <div class="col-md-10 pr-1">
                   <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Scheme ID</label>
                        <input type="text" name="scheme_id" class="form-control @if($errors->has('scheme_id')) is-invalid @endif" placeholder="Scheme ID" value="{{ $client->scheme_id }}" />
                        @error('scheme_id')
                            <div class="invalid-feedback">
                                {{ $errors->first('scheme_id') }}
                            </div>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" name="email" class="form-control  @if($errors->has('email')) is-invalid @endif" placeholder="Email" value="{{ $client->email }}" />
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @enderror
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control @if($errors->has('name')) is-invalid @endif" placeholder="" value="{{ $client->name }}" />
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Mobile</label>
                        <input type="text" name="mobile" class="form-control @if($errors->has('mobile')) is-invalid @endif" placeholder="Mobile" value="{{ $client->mobile }}" />
                        @error('mobile')
                            <div class="invalid-feedback">
                                {{ $errors->first('mobile') }}
                            </div>
                        @enderror
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-2 d-flex justify-content-center align-items-stretch pl-1 pt-4 pb-2">
                  <div class="card text-white bg-primary m-0 card-block card-big">
                    <div class="card-header text-center">Total Bins</div>
                    <div class="card-body pt-0 pb-0 text-center font-weight-bold">
                      <p class="card-text"> {{ $bin['total'] }}</p>
                    </div>
                  </div>
                </div>
              </div>
              
              <p class="m-0"><strong>On Hand Bin</strong></p>

              <div class="row">
                <div class="col-md-6 pr-1">
                  <div class="form-group">
                    <label>240 Ltr</label>
                    <input type="text" name="twotwo" class="form-control font-bold" placeholder="" value="{{ $bin['twotwo'] }}" />
                  </div>
                </div>
                <div class="col-md-6 pl-1">
                  <div class="form-group">
                    <label>1100 Ltr</label>
                    <input type="text" name="oneone" class="form-control" placeholder="" value="{{ $bin['oneone'] }}" />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 pr-1">
                  <div class="form-group">
                    <label for="dropoff2">Drop off Date</label>
                    <input id="dropoff2" name="dropoff_date" class="form-control form-control-lg" type="text" value="{{ $bin['dropoff_date'] }}" />
                  </div>
                </div>
                <div class="col-md-6 pl-1">
                  <div class="form-group">
                    <label for="company">Company</label>
                    <input id="company" name="company" class="form-control form-control-lg" type="text" value="{{ $bin['company'] }}" />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Address</label>
                    <input type="text" name="address" class="form-control @if($errors->has('address')) is-invalid @endif" placeholder="Complete Address" value="{{ $client->address }}" />
                     @error('address')
                        <div class="invalid-feedback">
                            {{ $errors->first('address') }}
                        </div>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4 pr-1">
                  <div class="form-group">
                    <label for="suburb">Suburb</label>
                  <input type="text" name="suburb" class="form-control @if($errors->has('suburb')) is-invalid @endif" placeholder="" value="{{ $client->suburb }}" />
                     @error('suburb')
                        <div class="invalid-feedback">
                            {{ $errors->first('suburb') }}
                        </div>
                    @enderror
                  </div>
                </div>
                <div class="col-md-4 pr-1 pl-1">
                  <div class="form-group">
                    <label for="state">State</label>
                    <input type="text" name="state" class="form-control @if($errors->has('state')) is-invalid @endif" placeholder="State" value="{{ $client->state }}" />
                     @error('state')
                        <div class="invalid-feedback">
                            {{ $errors->first('state') }}
                        </div>
                    @enderror
                  </div>
                </div>
                <div class="col-md-4 pl-1">
                  <div class="form-group">
                    <label for="postcode">Post Code</label>
                    <input type="number" name="postcode" class="form-control @if($errors->has('postcode')) is-invalid @endif" placeholder="" value="{{ $client->postcode }}" />
                     @error('postcode')
                        <div class="invalid-feedback">
                            {{ $errors->first('postcode') }}
                        </div>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div id='client-map'></div>
                </div>
              </div>
              <div class="row">
                <div class="update ml-auto mr-auto">
                  <button type="submit" class="btn btn-primary btn-round">Update Client</button>
                  <a href="{{ route('client.index') }}" class="btn btn-warning btn-round">Back</a>
                </div>
              </div>
            </form>
      </div>
    </div>

  <!-- Modal -->
  <div class="modal fade" id="addbin" tabindex="-1" role="dialog" aria-labelledby="addbin" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Add Bin</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="{{ route('client.bin',['id' => $client->id]) }}" method="POST">
            @csrf
            @method('post')
            <div class="modal-body">
              <div class="row">
                <div class="col-md-6 pr-1">
                  <div class="form-group">
                    <label for="twotwo">240 Ltr</label>
                  <input id="twotwo" name="twotwo" class="form-control form-control-lg" type="number" min="0" max="50" placeholder="0" value="{{ $bin['twotwo'] }}" />
                  </div>
                </div>
                <div class="col-md-6 pl-1">
                  <div class="form-group">
                    <label for="oneone">1100 Ltr</label>
                  <input id="oneone" name="oneone" class="form-control form-control-lg" type="number" min="0" max="50"  placeholder="0" value="{{ $bin['oneone'] }}" />
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 pr-1">
                  <div class="form-group">
                    <label for="dropoff">Drop off Date</label>
                    <input id="dropoff" name="dropoff_date" class="date form-control form-control-lg" type="text" value="{{ $bin['dropoff_date'] }}" />
                  </div>
                </div>
                <div class="col-md-6 pl-1">
                  <div class="form-group">
                    <label for="company">Company</label>
                    <input id="company" name="company" class="form-control form-control-lg" type="text" value="{{ $bin['company'] }}" />
                  </div>
                </div>
              </div>
            </div>
            
            <div class="modal-footer">
                  <input type="hidden" id="modal_id" name="id" value="">
                  <button type="button" class="btn btn-round btn-secondary mr-1" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-round btn-success">Add</button>
            </div>
          </form>
        </div>
      </div>
    </div>

  @section('script-bottom')
      <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
      <script>
        // TO MAKE THE MAP APPEAR YOU MUST
        // ADD YOUR ACCESS TOKEN FROM
        // https://account.mapbox.com
        mapboxgl.accessToken = 'pk.eyJ1IjoieW5ub3NzZW5jZSIsImEiOiJja2ZnZ3Vlcmkwa2poMzBvNWswNm5vaW9lIn0.6ESxbFhgeUncrEwnwPsh3Q';
        var map = new mapboxgl.Map({
          container: 'client-map',
          style: 'mapbox://styles/mapbox/streets-v11', // stylesheet location
          center: [{{ $client->lng }}, {{ $client->lat }}], // starting position [lng, lat]
          zoom: 14 // starting zoom
        });

        var marker = new mapboxgl.Marker()
          .setLngLat([{{ $client->lng }}, {{ $client->lat }}])
          .addTo(map);

        var markerHeight = 50, markerRadius = 10, linearOffset = 25;
        
        var popup = new mapboxgl.Popup({ className: 'my-class'})
          .setLngLat([{{ $client->lng }}, {{ $client->lat }}])
          .setHTML("<div class='mappop'>{{$client->name}}</div>")
          .setMaxWidth("300px")
          .addTo(map);

          
        

        jQuery(document).ready(function($) {
          $('button[data-toggle=modal]').click(function () {
            var data_id = '';
            if (typeof $(this).data('id') !== 'undefined') {
              data_id = $(this).data('id');
            }
            $('#modal_id').val(data_id);
          });

          $('.date').datepicker({
              format: 'yyyy-mm-dd',
              uiLibrary: 'bootstrap4'
          });
        });
    </script> 
    @endsection

@endsection
