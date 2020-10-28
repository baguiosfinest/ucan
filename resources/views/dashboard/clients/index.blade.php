@extends('layouts.dashboard')
@section('title','UCANRECYCLE WA Clients')
@section('maintitle', 'View All Clients')
@section('content')

  <div class="card">
      <div class="card-header clearfix">
        
        <h4 class="pull-left card-title"> 
          @if ($sort ?? '')
            Clients List By Postcodes
          @else
            Clients List
          @endif
          </h4>

          <div class="pull-right text-right">
            <a class="btn btn-primary btn-round" href="{{ route('client.booked') }}">For Pickup</a>
            <a class="btn btn-success btn-round" href="{{ route('client.create') }}">Add Client</a>
            <a class="btn btn-info btn-round mr-1" href="{{ route('client.map') }}">View Map</a>
            <a class="btn btn-warning btn-round mr-1" href="{{ route('client.sort') }}">Sort By Post Code</a>
            @if($sort ?? '')
              <p class="m-0">
                <a href="{{ route('client_sorted.pdf') }}" class="btn btn-round btn-sm btn-info">SAVE TO PDF</a>
              </p>
            @endif
          </div>
       
      </div>
      <div class="card-body">
        @if ($sort ?? '')

            @foreach ($clients as $key => $client)
              
            <div class="table-responsive">
              <table id="clients-table" class="table">
                <thead class=" text-success">
                  <tr>
                    <th colspan="7">
                      Postcode: 
                      {{ $key }}
                    </th>
                  </tr>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Scheme ID</th>
                    <th>Mobile</th>
                    <th>Address</th>
                    <th class="text-right">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($client as $item)
                      <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->scheme_id }}</td>
                        <td>{{ $item->mobile }}</td>
                        <td>{{ $item->suburb }} {{ $item->state }} {{ $item->postcode }}</td>
                        <td class="text-right">
                          <a href="/dashboard/clients_list/{{ $item->id }}" class="btn btn-sm btn-info btn-round">View</a>
                          <button class="btn btn-danger btn-round btn-sm" data-toggle="modal" data-id="{{ $item->id }}" data-target="#deleteconfirmation">x</button>
                        </td>
                      </tr>
                  @endforeach
                </tbody>
              </table>
          </div>
                      
            @endforeach

            
        @else
            @if (!$clients->isEmpty())
            <div class="table-responsive">
                <table id="clients-table" class="table">
                  <thead class=" text-success">
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Scheme ID</th>
                    <th>Mobile</th>
                    <th>Address</th>
                    <th class="text-right">Actions</th>
                  </thead>
                  <tbody>

                    @foreach ($clients as $client)
                        <tr>
                          <td>{{ ($clients->currentpage()-1) * $clients ->perpage() + $loop->index + 1 }}</td>
                          <td>{{ $client->name }}</td>
                          <td>{{ $client->email }}</td>
                          <td>{{ $client->scheme_id }}</td>
                          <td>{{ $client->mobile }}</td>
                          <td>{{ $client->suburb }} {{ $client->state }} {{ $client->postcode }}</td>
                          <td class="text-right">
                            <a title="Book for Pickup" href="/dashboard/clients_list/book/{{ $client->id }}" class="btn btn-sm btn-round m-1 {{ $client->forpickup ? 'btn-success' : 'btn-warning' }}"><i class="nc-icon nc-ambulance"></i></a>
                            <a href="/dashboard/clients_list/{{ $client->id }}" class="btn btn-sm btn-info btn-round m-1 ">View</a>
                            <button class="btn btn-danger btn-round btn-sm m-1" data-toggle="modal" data-id="{{ $client->id }}" data-target="#deleteconfirmation">x</button>
                          </td>
                        </tr>
                    @endforeach
                    
                    
                  </tbody>
                </table>
                {{ $clients->links() }}
            </div>
          @else
              <p class="text-center">No clients in database. Please add some clients.</p>
          @endif
        @endif
        
        
      </div>
    </div>

    <!-- Modal -->
  <div class="modal fade" id="deleteconfirmation" tabindex="-1" role="dialog" aria-labelledby="deleteconfirmation" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Delete Client</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Are you sure you want to delete this user? This will also delete user transactions like bin and pickup requests.
          </div>
          <div class="modal-footer">

            <form action="{{ route('client.delete') }}" method="POST">
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
          });

        });
    </script> 
    @endsection
@endsection
