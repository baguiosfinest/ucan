@extends('layouts.dashboard')
@section('title','UCANRECYCLE WA Users')
@section('maintitle', 'View All Users')
@section('content')
  {{-- @if (auth()->user()->is_admin == 1)
    @include('dashboard.includes.topcards-admin',['users' => $users, 'depots' => $depots])   
  @else
    @include('dashboard.includes.topcards',['users' => $users, 'depots' => $depots])
  @endif --}}

  <div class="card">
      <div class="card-header">
        <h4 class="card-title"> Users List</h4>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table">
            <thead class=" text-success">
              <th> Name</th>
              <th>Email</th>
              <th>Scheme ID</th>
              <th>Mobile</th>
              <th>Address</th>
              <th class="text-right">Actions</th>
            </thead>
            <tbody>
              @foreach ($users as $user)
                  <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->scheme_id }}</td>
                    <td>{{ $user->mobile }}</td>
                    <td>{{ $user->address }}</td>
                    <td class="text-right">
                      <a href="/dashboard/users_list/{{ $user->id }}" class="btn btn-sm btn-info btn-round">View</a>
                      <button class="btn btn-danger btn-round btn-sm" data-toggle="modal" data-id="{{ $user->id }}" data-target="#deleteconfirmation">x</button>
                    </td>
                  </tr>
              @endforeach
              
              
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Modal -->
<div class="modal fade" id="deleteconfirmation" tabindex="-1" role="dialog" aria-labelledby="deleteconfirmation" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Delete User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Are you sure you want to delete this user? This will also delete user transactions like bin and pickup requests.
        </div>
        <div class="modal-footer">

          <form action="{{ route('user.delete') }}" method="POST">
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
