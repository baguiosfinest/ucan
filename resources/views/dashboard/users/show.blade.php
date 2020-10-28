@extends('layouts.dashboard')
@section('title','View User')
@section('maintitle', 'View User')
@section('content')

  <div class="card">
      <div class="card-header clearfix">
        <h4 class="card-title pull-left"> 
          User Information
        </h4>
        <button class="pull-right btn btn-danger btn-round" data-toggle="modal" data-id="{{ $user->id }}" data-target="#deleteconfirmation">Delete User</button>
      </div>
      <div class="card-body">
        <form method="POST" action="{{ route('user.update') }}">
              <input type="hidden" name="user_id" value="{{ $user->id }}">
              @csrf
              @method('PUT')

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
                <div class="col-md-12">
                  <div class="form-group">
                    <label>About Me</label>
                    <textarea class="form-control textarea" name="aboutme" placeholder="Some awesome intro about yourself.">{{ $user->aboutme }}</textarea>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="update ml-auto mr-auto">
                  <button type="submit" class="btn btn-primary btn-round">Update User</button>
                  <a href="/dashboard/users_list/" class="btn btn-warning btn-round">Back</a>
                </div>
              </div>
            </form>
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
          Are you sure you want to delete this user?
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
