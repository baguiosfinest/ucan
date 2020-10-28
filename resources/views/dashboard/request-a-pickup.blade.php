@extends('layouts.dashboard')
@section('title', 'Request a Pickup')
@section('maintitle', 'Request a Pickup')
@section('script-top')
  <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
@endsection


@section('content')

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <div class="places-buttons">
            <div class="row">
              <div class="col-md-6 ml-auto mr-auto text-center">
                <h4 class="card-title">
                  My Pickup Requests
                  <p class="category">Pickup Requests</p>
                </h4>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-12">
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-success">
                      <th>#</th>
                      <th>Name</th>
                      <th>Scheme ID</th>
                      <th>Address</th>
                      <th>Qty</th>
                      <th>Preffered Date</th>
                      <th>Preffered Time</th>
                      <th>Status</th>
                      <th class="text-right">Actions</th>
                    </thead>
                    <tbody>
                      @if(!$bookings->isEmpty())
                        @foreach ($bookings as $booking)
                          @php
                              $rowclass = "";
                              if(!$booking->instructions) {
                                $rowclass .= "table-row-sep ";
                              }
                              if($booking->status == 'accepted') {
                                $rowclass .= "table-success ";
                              } elseif($booking->status == 'rejected') {
                                $rowclass .= "table-danger ";
                              } elseif($booking->status == 'done') {
                                $rowclass .= "table-dark ";
                              }
                          @endphp

                            <tr class="{{ $rowclass }}">
                              <td @if ($booking->instructions) rowspan="2" class="table-row-sep" @endif >{{ $loop->iteration }}</td>
                              <td @if ($booking->instructions) rowspan="2" class="table-row-sep" @endif >{{ $booking->name }}</td>
                              <td @if ($booking->instructions) rowspan="2" class="table-row-sep" @endif >{{ $booking->scheme_id }}</td>
                              <td>{{ $booking->address }}</td>
                              <td>{{ $booking->no_of_bins }}</td>
                              <td>{{ $booking->expected_date }}</td>
                              <td>{{ $booking->expected_time }}</td>
                              <td>{{ $booking->status }}</td>
                              <td @if ($booking->instructions) rowspan="2" @endif class="text-right @if ($booking->instructions) table-row-sep @endif">
                                  <button class="btn btn-danger btn-round btn-sm" data-toggle="modal" data-id="{{ $booking->id }}" data-target="#deleteconfirmation">x</button>
                                  
                              </td>
                            </tr>
                            @if ($booking->instructions)
                              <tr class="table-row-sep {{ $rowclass }}">
                                <td colspan="1" class="p-1 font-weight-bold text-success text-uppercase">Additional Instructions</td>
                                <td colspan="4" class="p-1">
                                   {{ $booking->instructions }}
                                </td>
                              </tr>
                            @endif
                            
                        @endforeach
                      @else
                        <tr class="text-center">
                          <td colspan="8"><p>No pickup requests yet! <br /> To book for a pick up, fill up the form below.</p></td>
                        </tr>
                      @endif
                      
                    </tbody>
                  </table>
                </div>

              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
<div class="modal fade" id="deleteconfirmation" tabindex="-1" role="dialog" aria-labelledby="deleteconfirmation" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Delete Request</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Are you sure you want to delete this pickup request?
        </div>
        <div class="modal-footer">

          <form action="{{ route('pickup-delete') }}" method="POST">
              @csrf
              @method('delete')
              <input type="hidden" id="modal_id" name="id" value="">
              <button type="button" class="btn btn-round btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-round btn-danger">Okay</button>
            </form>
        </div>
      </div>
    </div>
  </div>
    

  <div class="card">
      <div class="card-header clearfix">
        <h4 class="card-title"> 
          Request a Pickup
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

        <form method="POST" action="{{ route('pickup-create') }}">
              
              @csrf
              @method('POST')
              <input type="hidden" name="type" value="pickup" />
              <input type="hidden" name="user_id" value="{{ $user->id }}" />

              <div class="row">
                <div class="col-md-6 pr-1">
                  <div class="form-group">
                    <label for="schemeid">Scheme ID</label>
                    <input type="text" id="schemeid" name="scheme_id" class="form-control" placeholder="Scheme ID" value="{{ $user->scheme_id }}">
                  </div>
                </div>
                <div class="col-md-6 pl-1">
                  <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Email" value={{ $user->email }}>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 pr-1">
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="" value="{{ $user->name }}">
                  </div>
                </div>
                <div class="col-md-6 pl-1">
                  <div class="form-group">
                    <label for="mobile">Mobile</label>
                    <input type="text" id="mobile" name="mobile" class="form-control" placeholder="Mobile" value="{{ $user->mobile }}">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" id="address" name="address" class="form-control" placeholder="Home Address" value="{{ $user->address }}">
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
                    <textarea class="form-control textarea" name="instructions" placeholder="Give some instructions for our driver to follow when picking up your bag of containers.">{{ $user->instructions }}</textarea>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="update ml-auto mr-auto">
                  <button type="submit" class="btn btn-primary btn-round">Request a Pickup</button>
                  <a href="{{ route('dashboard') }}" class="btn btn-warning btn-round">Back</a>
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
