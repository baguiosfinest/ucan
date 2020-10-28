@extends('layouts.dashboard')
@section('title','UCANRECYCLE WA Transactions Page')
@section('maintitle','Client Transactions')
@section('content')
    {{-- {{ dd($user) }} --}}
  
  <div class="row">
    <div class="col-sm-12">

      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
          <a class="nav-link active" id="home-tab" data-toggle="tab" href="#bin" role="tab" aria-controls="bin" aria-selected="true">Bin Request</a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link" id="profile-tab" data-toggle="tab" href="#pickup" role="tab" aria-controls="pickup" aria-selected="false">Pickup Requests</a>
        </li>
      </ul>
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="bin" role="tabpanel" aria-labelledby="home-tab">
        
        <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <div class="places-buttons">
                    <div class="row">
                      <div class="col-md-12 ml-auto mr-auto text-left">
                        <a href="{{ route('bin.pdf') }}" class="btn btn-round btn-sm btn-info pull-right">SAVE TO PDF</a>
                        <a href="{{ route('bin.csv') }}" class="btn btn-round btn-sm btn-info pull-right mr-1">Download CSV</a>
                        <h4 class="card-title">
                          BIN REQUESTS
                          <p class="category">Clients Bin Requests</p>
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
                              @if(!$bins->isEmpty())
                                @foreach ($bins as $bin)
                                    <tr>
                                      <td>{{ $bin->id }}</td>
                                      <td>{{ $bin->name }}</td>
                                      <td>{{ $bin->scheme_id }}</td>
                                      <td>{{ $bin->address }}</td>
                                      <td>{{ $bin->no_of_bins }}</td>
                                      <td>{{ $bin->mobile }}</td>
                                      <td>{{ $bin->bintype }}</td>
                                      <td>{{ $bin->status }}</td>
                                      <td class="text-right">
                                          <button class="btn btn-danger btn-round btn-sm" data-toggle="modal" data-id="{{ $bin->id }}" data-target="#deleteconfirmation">x</button>
                                          
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
        
        </div>
        <div class="tab-pane fade" id="pickup" role="tabpanel" aria-labelledby="profile-tab">
        
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <div class="places-buttons">
                    <div class="row">
                      <div class="col-md-12 ml-auto mr-auto text-left">
                        <div class="pull-right text-right">
                          <p class="m-0">
                            <a href="{{ route('pickup.pdf') }}" class="btn btn-round btn-sm btn-info">SAVE TO PDF</a>
                            <a href="{{ route('pickup.csv') }}" class="btn btn-round btn-sm btn-info mr-1">Download CSV</a>
                          </p>
                          <a href="{{ route('transactions.create') }}" class="btn btn-round btn btn-success">Add Custom Pickup</a>
                        </div>
                        <h4 class="card-title">
                          PICKUP REQUESTS
                          <p class="category">Clients PICKUP Requests</p>
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
                              <th>Company</th>
                              <th>Preffered Date</th>
                              <th>Preffered Time</th>
                              <th>Status</th>
                              <th class="text-right">Actions</th>
                            </thead>
                            <tbody>
                              @if(!$pickups->isEmpty())
                                @foreach ($pickups as $pickup)
                                    <tr class="@php
                                      if($pickup->status == 'accepted') {
                                        echo 'bg-success';
                                      } elseif($pickup->status == 'declined'){
                                        echo 'bg-warning';
                                      } elseif($pickup->status == 'done'){
                                        echo 'bg-secondary text-white';
                                      }
                                    @endphp">
                                      <td>{{ $pickup->id }}</td>
                                      <td>{{ $pickup->name }}</td>
                                      <td>{{ $pickup->scheme_id }}</td>
                                      <td>{{ $pickup->address }}</td>
                                      <td>{{ $pickup->no_of_bins }}</td>
                                      <td>{{ $pickup->company }}</td>
                                      <td>{{ $pickup->expected_date }}</td>
                                      <td>{{ $pickup->expected_time }}</td>
                                      
                                      <td>
                                        <form action="{{ route('transactions.status') }}" method="POST">
                                          @csrf
                                          @method('put')
                                          <input type="hidden" name="id" value="{{ $pickup->id }}" />
                                          <select name="status" class="form-control">
                                            @if ($pickup->status == 'accepted')
                                              <option value="{{ $pickup->status }}">{{ $pickup->status }}</option>
                                              <option value="done">done</option>
                                              <option value="declined">declined</option>
                                            @elseif($pickup->status == 'done')
                                              <option value="{{ $pickup->status }}">{{ $pickup->status }}</option>
                                              <option value="accepted">accepted</option>
                                              <option value="declined">declined</option>
                                            @elseif($pickup->status == 'declined')
                                              <option value="{{ $pickup->status }}">{{ $pickup->status }}</option>
                                              <option value="accepted">accepted</option>
                                              <option value="done">done</option>
                                            @elseif($pickup->status == 'pending')
                                              <option value="{{ $pickup->status }}">{{ $pickup->status }}</option>
                                              <option value="accepted">accepted</option>
                                              <option value="declined">declined</option>
                                              <option value="done">done</option>
                                            @else
                                              <option value="{{ $pickup->status }}">{{ $pickup->status }}</option>
                                            @endif
                                          </select>
                                          <button type="submit" class="btn btn-round btn-sm mt-1 btn-info">Update</button>
                                        </form>
                                      </td>
                                      <td class="text-right">
                                          <button class="btn btn-danger btn-round btn-sm" data-toggle="modal" data-id="{{ $pickup->id }}" data-target="#deleteconfirmation">Delete</button>
                                      </td>
                                    </tr>
                                @endforeach
                              @else
                                <tr class="text-center">
                                  <td colspan="9"><p>No pickup requests yet! <br /> To book for a pick up, fill up the form below.</p></td>
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
          Are you sure you want to delete this transaction?
        </div>
        <div class="modal-footer">

          <form action="{{ route('transactions-delete') }}" method="POST">
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

