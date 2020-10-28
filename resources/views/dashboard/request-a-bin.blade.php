@extends('layouts.dashboard')
@section('title', 'Request a Bin')
@section('maintitle', 'Request a Bin')
@section('content')

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <div class="places-buttons">
            <div class="row">
              <div class="col-md-6 ml-auto mr-auto text-center">
                <h4 class="card-title">
                  My Bin Requests
                  <p class="category">Bin Requests</p>
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
                      <th>Mobile</th>
                      <th>Bin Type</th>
                      <th>Status</th>
                      <th class="text-right">Actions</th>
                    </thead>
                    <tbody>
                      @if(!$bookings->isEmpty())
                        @foreach ($bookings as $booking)
                            <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>{{ $booking->name }}</td>
                              <td>{{ $booking->scheme_id }}</td>
                              <td>{{ $booking->address }}</td>
                              <td>{{ $booking->no_of_bins }}</td>
                              <td>{{ $booking->mobile }}</td>
                              <td>{{ $booking->bintype }}</td>
                              <td>{{ $booking->status }}</td>
                              <td class="text-right">
                                  <button class="btn btn-danger btn-round btn-sm" data-toggle="modal" data-id="{{ $booking->id }}" data-target="#deleteconfirmation">x</button>
                                  
                              </td>
                            </tr>
                        @endforeach
                      @else
                        <tr class="text-center">
                          <td colspan="9"><p>No bin requests yet! <br /> To book for a bin, fill up the form below.</p></td>
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

          <form action="{{ route('bin-delete') }}" method="POST">
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
          Request a Bin
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

        <form method="POST" action="{{ route('bin-create') }}">
              
              @csrf
              @method('POST')
              <input type="hidden" name="type" value="bin" />
              <input type="hidden" name="user_id" value="{{ $user->id }}" />
              <div class="row">
                <div class="col-md-6 pr-1">
                  <div class="form-group">
                    <label>Scheme ID</label>
                    <input type="text" name="scheme_id" class="form-control" placeholder="Scheme ID" value="{{ $user->scheme_id }}">
                  </div>
                </div>
                <div class="col-md-6 pl-1">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" name="email" class="form-control" placeholder="Email" value={{ $user->email }}>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 pr-1">
                  <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" placeholder="" value="{{ $user->name }}">
                  </div>
                </div>
                <div class="col-md-6 pl-1">
                  <div class="form-group">
                    <label>Mobile</label>
                    <input type="text" name="mobile" class="form-control" placeholder="Mobile" value="{{ $user->mobile }}">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Address</label>
                    <input type="text" name="address" class="form-control" placeholder="Home Address" value="{{ $user->address }}">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 pr-1">
                  <div class="form-group">
                    <label for="numberofbins">Number of Bins</label>
                    <select class="form-control" name="numberofbins" id="numberofbins">
                      <option value="1">1</option>
                      @php
                          for($i = 2; $i <= 30; $i++) {
                            echo "<option value=". $i .">" . $i . "</option>";
                          }
                      @endphp
                    </select>
                  </div>
                </div>
                <div class="col-md-6 pl-1">
                  <div class="form-group">
                    <label for="bintype">Bin Type</label>
                    <select class="form-control" name="bintype" id="bintype">
                      <option value="240ltr">240 Ltr</option>
                      <option value="1100ltr">1100 Ltr</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Instructions</label>
                    <textarea class="form-control textarea" name="instructions" placeholder="Instructions">{{ $user->instructions }}</textarea>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="update ml-auto mr-auto">
                  <button type="submit" class="btn btn-primary btn-round">Request a Bin</button>
                  <a href="{{ route('dashboard') }}" class="btn btn-warning btn-round">Back</a>
                </div>
              </div>
            </form>
      </div>
    </div>
    @section('script-bottom')
     
      <script type="text/javascript">
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
