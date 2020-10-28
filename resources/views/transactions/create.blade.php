@extends('layouts.dashboard')
@section('title', 'Request a Custom Pickup')
@section('maintitle', 'Request a Custom Pickup')
@section('script-top')
  <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
@endsection


@section('content')

  <div class="card">
      <div class="card-header clearfix">
        <h4 class="card-title"> 
          Request a Custom Pickup
        </h4>
      </div>
      
      <div class="card-body">
        @if ($errors->any())
          <div class="alert alert-danger alert-dismissible fade show">
              <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                <i class="nc-icon nc-simple-remove"></i>
              </button>
              <ul class="m-0">
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('transactions.store') }}">
              
              @csrf
              @method('POST')
              <input type="hidden" name="type" value="pickup" />
              <input type="hidden" name="user_id" value="{{ auth()->user()->id }}" />
              <div class="row">
                <div class="col-md-4 pr-1">
                  <div class="form-group">
                    <label for="schemeid">Scheme ID</label>
                    <input type="text" id="schemeid" name="scheme_id" class="form-control" placeholder="Scheme ID" value="" />
                  </div>
                </div>
                <div class="col-md-4 pl-1 pr-1">
                  <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Email" value="" />
                  </div>
                </div>
                <div class="col-md-4 pl-1">
                  <div class="form-group">
                    <label for="company">Company</label>
                    <input type="text" id="company" name="company" class="form-control" placeholder="Company" value="" />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 pr-1">
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="" value="" />
                  </div>
                </div>
                <div class="col-md-6 pl-1">
                  <div class="form-group">
                    <label for="mobile">Mobile</label>
                    <input type="text" id="mobile" name="mobile" class="form-control" placeholder="Mobile" value="" />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" id="address" name="address" class="form-control" placeholder="Home Address" value="" />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4 pr-1">
                  <div class="form-group">
                    <label for="numberofbins">Estimated Number of Bins or Bags</label>
                    <input type="text" name="numberofbins" id="numberofbins" class="form-control" placeholder="Number of Bins" value="" />
                  </div>
                </div>
                <div class="col-md-4 px-1">
                  <div class="form-group date-wrapper">
                    <label for="dateofpickup">Prefferred Date of Pick Up</label>
                    <input type="text" name="dateofpickup" id="dateofpickup" class="date form-control" placeholder="Prefferred Date" value="" />
                  </div>
                </div>
                <div class="col-md-4 pl-1">
                  <div class="form-group">
                    <label for="timeofpickup">Preffered Time of Pick Up</label>
                    <select name="timeofpickup" class="form-control" id="timeofpickup"><option value="Any Time">Any Time</option><option value="7:00AM">7:00AM</option><option value="8:00AM">8:00AM</option><option value="9:00AM">9:00AM</option><option value="10:00AM">10:00AM</option><option value="11:00AM">11:00AM</option><option value="12:00PM">12:00PM</option><option value="1:00PM">1:00PM</option><option value="2:00PM">2:00PM</option><option value="3:00PM">3:00PM</option><option value="400PM">400PM</option><option value="5:00PM">5:00PM</option><option value="6:00PM">6:00PM</option></select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Instructions</label>
                    <textarea class="form-control textarea" name="instructions" placeholder="Give some instructions for our driver to follow when picking up your bag of containers."></textarea>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="update ml-auto mr-auto">
                  <button type="submit" class="btn btn-primary btn-round">Request a Pickup</button>
                  <a href="{{ route('dashboard.transactions') }}" class="btn btn-warning btn-round">Back</a>
                </div>
              </div>
            </form>
      </div>
    </div>
    @section('script-bottom')
      <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
      <script type="text/javascript">
        jQuery('.date').datepicker({
            format: 'yyyy-mm-dd',
            uiLibrary: 'bootstrap4'
        });

        jQuery(document).ready(function($) {
          $('button[data-toggle=modal]').click(function () {
            var data_id = '';
            if (typeof $(this).data('id') !== 'undefined') {
              data_id = $(this).data('id');
            }
            $('#modal_id').val(data_id);
          })
        });
    </script> 
    @endsection
    
@endsection
