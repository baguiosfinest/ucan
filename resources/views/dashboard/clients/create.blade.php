@extends('layouts.dashboard')
@section('title','Add New Clients')
@section('maintitle', 'Add New Clients')
@section('content')

  <div class="card">
      <div class="card-header clearfix">
        <h4 class="pull-left card-title">Add New Client</h4>
        <a class="pull-right btn btn-danger btn-round" href="{{ route('client.index') }}">Back</a>
      </div>
      <div class="card-body">
        <form method="POST" action="{{ route('client.create') }}">
              {{ csrf_field() }}
              @method('POST')

              <div class="row">
                <div class="col-md-6 pr-1">
                  <div class="form-group">
                    <label>Scheme ID</label>
                    <input type="text" name="scheme_id" class="form-control @if($errors->has('scheme_id')) is-invalid @endif" placeholder="Scheme ID" value="" />
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
                    <input type="email" name="email" class="form-control  @if($errors->has('email')) is-invalid @endif" placeholder="Email" value="" />
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
                    <input type="text" name="name" class="form-control @if($errors->has('name')) is-invalid @endif" placeholder="" value="" />
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
                    <input type="text" name="mobile" class="form-control @if($errors->has('mobile')) is-invalid @endif" placeholder="Mobile" value="" />
                     @error('mobile')
                        <div class="invalid-feedback">
                            {{ $errors->first('mobile') }}
                        </div>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Address</label>
                    <input type="text" name="address" class="form-control @if($errors->has('address')) is-invalid @endif" placeholder="Street Address" value="" />
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
                    <input type="text" name="suburb" class="form-control @if($errors->has('suburb')) is-invalid @endif" placeholder="" value="" />
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
                    <input type="text" name="state" class="form-control @if($errors->has('state')) is-invalid @endif" placeholder="State" value="" />
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
                    <input type="number" name="postcode" class="form-control @if($errors->has('postcode')) is-invalid @endif" placeholder="" value="" />
                     @error('postcode')
                        <div class="invalid-feedback">
                            {{ $errors->first('postcode') }}
                        </div>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="update ml-auto mr-auto">
                  <button type="submit" class="btn btn-primary btn-round">Add New Client</button>
                  <a href="{{ route('client.index') }}" class="btn btn-warning btn-round">Back</a>
                </div>
              </div>
            </form>
      </div>
    </div>
  
@endsection
